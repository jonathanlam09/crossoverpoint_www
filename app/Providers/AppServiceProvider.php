<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\AccountOfferings;
use App\Observers\AccountOfferingsObserver;

use App\Models\AccountOfferingDeductions;
use App\Observers\AccountOfferingDeductionsObserver;

use App\Models\AccountOfferingCheques;
use App\Observers\AccountOfferingChequesObserver;

use App\Models\AuditLogs;
use App\Observers\AuditLogsObserver;

use App\Models\Users;
use App\Observers\UsersObserver;

use App\Models\Groups;
use App\Observers\GroupsObserver;

use App\Models\GalleryTopics;
use App\Observers\GalleryTopicsObserver;

use App\Models\GalleryTopicMedia;
use App\Observers\GalleryTopicMediaObserver;

use App\Models\GalleryHighlights;
use App\Observers\GalleryHighlightsObserver;

use App\Models\PCO;
use App\Observers\PCOObserver;

use App\Models\PCORequests;
use App\Observers\PCORequestsObserver;

use App\Models\PCOSongs;
use App\Observers\PCOSongsObserver;

use App\Models\PCOSongArrangements;
use App\Observers\PCOSongArrangementsObserver;

use App\Models\PCORoles;
use App\Observers\PCORolesObserver;

use App\Models\Sermons;
use App\Observers\SermonsObserver;

use App\Models\SermonAttachments;
use App\Observers\SermonAttachmentsObserver;

use App\Models\PCOTeams;
use App\Observers\PCOTeamsObserver;

use App\Models\PCOTeamMembers;
use App\Observers\PCOTeamMembersObserver;

use App\Models\Events;
use App\Observers\EventsObserver;

use App\Models\Attendance;
use App\Observers\AttendanceObserver;

use App\Models\Songs;
use App\Observers\SongsObserver;

use App\Models\SongAttachments;
use App\Observers\SongAttachmentsObserver;

use App\Models\GroupMembers;
use App\Observers\GroupMembersObserver;

use App\Models\PCOAttachments;
use App\Observers\PCOAttachmentsObserver;

use App\Models\Menus;
use App\Observers\MenusObserver;

use App\Models\Permissions;
use App\Observers\PermissionsObserver;

use App\Models\EventAttachments;
use App\Observers\EventAttachmentsObserver;

use App\Models\EventSignUps;
use App\Observers\EventSignUpsObserver;

use App\Models\Visitors;
use App\Observers\VisitorsObserver;

use App\Models\UserUnavailability;
use App\Observers\UserUnavailabilityObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AuditLogs::observe(AuditLogsObserver::class);
        Attendance::observe(AttendanceObserver::class);
        AccountOfferings::observe(AccountOfferingsObserver::class);
        AccountOfferingCheques::observe(AccountOfferingChequesObserver::class);
        AccountOfferingDeductions::observe(AccountOfferingDeductionsObserver::class);
        Events::observe(EventsObserver::class);
        EventSignUps::observe(EventSignUpsObserver::class);
        EventAttachments::observe(EventAttachmentsObserver::class);
        Groups::observe(GroupsObserver::class);
        GroupMembers::observe(GroupMembersObserver::class);
        GalleryTopics::observe(GalleryTopicsObserver::class);
        GalleryHighlights::observe(GalleryHighlightsObserver::class);
        GalleryTopicMedia::observe(GalleryTopicMediaObserver::class);
        PCO::observe(PCOObserver::class);
        PCORoles::observe(PCORolesObserver::class);
        PCOSongs::observe(PCOSongsObserver::class);
        PCOSongArrangements::observe(PCOSongArrangementsObserver::class);
        PCORequests::observe(PCORequestsObserver::class);
        PCOTeams::observe(PCOTeamsObserver::class);
        PCOTeamMembers::observe(PCOTeamMembersObserver::class);
        Sermons::observe(SermonsObserver::class);
        SermonAttachments::observe(SermonAttachmentsObserver::class);
        Users::observe(UsersObserver::class);
        UserUnavailability::observe(UserUnavailabilityObserver::class);
        Songs::observe(SongsObserver::class);
        SongAttachments::observe(SongAttachmentsObserver::class);
        PCOAttachments::observe(PCOAttachmentsObserver::class);
        Menus::observe(MenusObserver::class);
        Permissions::observe(PermissionsObserver::class);
        Visitors::observe(VisitorsObserver::class);
    }
}
