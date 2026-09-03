<?php
namespace Bookly\Support;

class LanguageSwitcher
{
    public static function render(): string
    {
        $current = Language::current();
        $supported = Language::supported();
        $detected = Language::detectedCountry();
        $hint = $detected ? ' · ' . Language::t('lang.detected', ['country' => $detected]) : '';
        $html = '<div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left">';
        $html .= '<button type="button" @click="open = !open" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium border border-black/10 hover:bg-black/5 transition" style="background: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">';
        $html .= '<span>' . $supported[$current]['flag'] . '</span>';
        $html .= '<span>' . e($supported[$current]['native']) . '</span>';
        $html .= '<svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 4l3 3 3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        $html .= '</button>';
        $html .= '<div x-show="open" x-transition style="display:none" class="absolute right-0 mt-2 w-56 rounded-2xl shadow-2xl border border-black/5 z-50 overflow-hidden" :style="`background: rgba(255,255,255,0.95); backdrop-filter: blur(20px);`">';
        $html .= '<div class="p-2">';
        foreach ($supported as $code => $info) {
            $active = $code === $current ? 'background: #F5F5F7;' : '';
            $html .= '<a href="/lang/' . $code . '" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm hover:bg-black/5" style="' . $active . '">';
            $html .= '<span class="text-lg">' . $info['flag'] . '</span>';
            $html .= '<span class="flex-1 text-left">' . e($info['native']) . '</span>';
            if ($code === $current) {
                $html .= '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 7l3 3 5-6" stroke="#0071E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
            }
            $html .= '</a>';
        }
        $html .= '</div>';
        if ($hint) {
            $html .= '<div class="px-4 py-2 border-t border-black/5 text-[10px] text-black/40 text-center">' . $hint . '</div>';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
