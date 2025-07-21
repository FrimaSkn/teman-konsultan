<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\ServicesCategory;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Domains\Announcement\Services\AnnouncementService;

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

        View::composer(['frontend.index', 'frontend.layouts.dashboard'], function ($view) use ($announcementService) {
            $view->with('announcements', $announcementService->getForFrontend());
        });

        View::composer(['backend.layouts.app'], function ($view) use ($announcementService) {
            $view->with('announcements', $announcementService->getForBackend());
        });

        View::composer(['frontend.includes.navigation'], function ($view) {
            $services = ServicesCategory::with('services')->get();
            $view->with('services', $services);
        });

        View::composer(['frontend.layouts.app', 'frontend.pages.contact-us'], function ($view) {
            $generalSettings = new GeneralSettings;
            $view->with('generalSettings', $generalSettings);
        });

        View::composer(['backend.includes.sidebar'], function ($view) {
            $view->with([
                'unread_contacts' => Contact::where('is_read', false)->count(),
                'unread_consultations' => \App\Models\Consultation::where('is_read', false)->count(),
            ]);
        });
    }
}
