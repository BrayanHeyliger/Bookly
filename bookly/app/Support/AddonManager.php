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

    public function install(string $slug): void
    {
        $this->db->update('addons', ['is_installed' => 1, 'is_active' => 1, 'updated_at' => date('Y-m-d H:i:s')], 'slug = ?', [$slug]);
    }

    public function uninstall(string $slug): void
    {
        $this->db->update('addons', ['is_installed' => 0, 'is_active' => 0, 'updated_at' => date('Y-m-d H:i:s')], 'slug = ?', [$slug]);
    }

    public function toggle(string $slug): void
    {
        $a = $this->find($slug);
        if (! $a) return;
        $installed = $a['is_installed'] ? 1 : 1;
        $active = $a['is_active'] ? 0 : 1;
        $this->db->update('addons', ['is_installed' => $installed, 'is_active' => $active, 'updated_at' => date('Y-m-d H:i:s')], 'slug = ?', [$slug]);
    }
}
