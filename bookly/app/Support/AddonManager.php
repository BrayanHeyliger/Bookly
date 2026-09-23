<?php

namespace Bookly\Support;

class AddonManager
{
    private static ?AddonManager $instance = null;
    public array $catalog;
    public DB $db;

    private function __construct(DB $db)
    {
        $this->db = $db;
        $this->catalog = require BOOKLY_ROOT.'/config/addons.php';
        $this->sync();
    }

    public static function instance(DB $db): self
    {
        return self::$instance ??= new self($db);
    }

    /** Does the slug exist in config/addons.php? */
    public function exists(string $slug): bool
    {
        return isset($this->catalog[$slug]);
    }

    public function sync(): void
    {
        $now = date('Y-m-d H:i:s');
        foreach ($this->catalog as $slug => $data) {
            $existing = $this->db->first('SELECT id, is_installed, is_active FROM addons WHERE slug = ?', [$slug]);
            if (! $existing) {
                $this->db->insert('addons', [
                    'name' => $data['name'],
                    'slug' => $slug,
                    'description' => $data['description'],
                    'long_description' => $data['long_description'] ?? $data['description'],
                    'category' => $data['category'] ?? 'general',
                    'price' => $data['price'] ?? 0,
                    'icon' => $data['icon'] ?? null,
                    'color' => $data['color'] ?? '#0071E3',
                    'version' => $data['version'] ?? '1.0.0',
                    'author' => $data['author'] ?? 'Bookly Labs',
                    'is_installed' => 0,
                    'is_active' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function all(): array
    {
        return $this->db->all('SELECT * FROM addons ORDER BY category, name');
    }

    public function find(string $slug): ?array
    {
        return $this->db->first('SELECT * FROM addons WHERE slug = ?', [$slug]);
    }

    public function isActive(string $slug): bool
    {
        $a = $this->find($slug);
        return $a && $a['is_installed'] && $a['is_active'];
    }

    public function activeSlugs(): array
    {
        return array_column(
            $this->db->all('SELECT slug FROM addons WHERE is_installed = 1 AND is_active = 1'),
            'slug'
        );
    }

    /** @return bool false when the slug is not part of the catalog. */
    public function install(string $slug): bool
    {
        if (! $this->exists($slug)) return false;
        $this->db->update('addons', ['is_installed' => 1, 'is_active' => 1, 'updated_at' => date('Y-m-d H:i:s')], 'slug = ?', [$slug]);
        return true;
    }

    /** @return bool false when the slug is not part of the catalog. */
    public function uninstall(string $slug): bool
    {
        if (! $this->exists($slug)) return false;
        $this->db->update('addons', ['is_installed' => 0, 'is_active' => 0, 'updated_at' => date('Y-m-d H:i:s')], 'slug = ?', [$slug]);
        return true;
    }

    /** @return bool false when the slug is not part of the catalog. */
    public function toggle(string $slug): bool
    {
        $a = $this->find($slug);
        if (! $a || ! $this->exists($slug)) return false;

        $active = (int)$a['is_active'] ? 0 : 1;
        $this->db->update('addons', [
            'is_installed' => 1,
            'is_active' => $active,
            'updated_at' => date('Y-m-d H:i:s'),
        ], 'slug = ?', [$slug]);

        return true;
    }
}
