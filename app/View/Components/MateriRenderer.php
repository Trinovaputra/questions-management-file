<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Materi;

class MateriRenderer extends Component
{
    public $materi;

    public function __construct(Materi $materi)
    {
        $this->materi = $materi;
    }

    public function render()
    {
        return view('components.materi-renderer');
    }

    /**
     * ambil youtube id
     */
    public function youtubeId()
    {
        if (!$this->materi->youtube_url) return null;

        preg_match('/(youtu\.be\/|v=)([a-zA-Z0-9_-]+)/', $this->materi->youtube_url, $matches);

        return $matches[2] ?? null;
    }
}
