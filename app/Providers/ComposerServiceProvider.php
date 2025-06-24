<?php

namespace App\Providers;

use App\Domains\Announcement\Services\AnnouncementService;
use App\Models\Contact;
use App\Models\ServicesCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ComposerServiceProvider.
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @param  AnnouncementService  $announcementService
     */
    public function boot(AnnouncementService $announcementService)
    {
        View::composer('*', function ($view) {
            $view->with('logged_in_user', auth()->user());
        });

        View::composer(['frontend.index', 'frontend.layouts.app'], function ($view) use ($announcementService) {
            $view->with('announcements', $announcementService->getForFrontend());
        });

        View::composer(['backend.layouts.app'], function ($view) use ($announcementService) {
            $view->with('announcements', $announcementService->getForBackend());
        });

        View::composer(['frontend.includes.navigation'], function ($view) {
            $services = ServicesCategory::with('services')->get();
            $view->with('services', $services);
        });

        View::composer(['backend.includes.sidebar'], function ($view) {
            $view->with([
                'unread_contacts' => Contact::where('is_read', false)->count(),
                'unread_consultations' => \App\Models\Consultation::where('is_read', false)->count(),
            ]);
        });
    }
}
