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

use App\Models\Services;
use App\Observers\ServicesObserver;

use App\Models\ServiceAttachments;
use App\Observers\ServiceAttachmentsObserver;

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

use App\Models\Permissions;
use App\Observers\PermissionsObserver;

use App\Models\EventAttachments;
use App\Observers\EventAttachmentsObserver;

use App\Models\EventRooms;
use App\Observers\EventRoomsObserver;

use App\Models\EventRegistrations;
use App\Observers\EventRegistrationsObserver;

use App\Models\EventRegistrationReceipts;
use App\Observers\EventRegistrationReceiptsObserver;

use App\Models\Visitors;
use App\Observers\VisitorsObserver;

use App\Models\UserUnavailability;
use App\Observers\UserUnavailabilityObserver;

use App\Models\UserRelationships;
use App\Observers\UserRelationshipsObserver;

use App\Models\Modules;
use App\Observers\ModulesObserver;

use App\Models\EventRoomAttachments;
use App\Observers\EventRoomAttachmentsObserver;

use App\Models\EventRoomArrangements;
use App\Observers\EventRoomArrangementsObserver;


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
        EventRegistrations::observe(EventRegistrationsObserver::class);
        EventRegistrationReceipts::observe(EventRegistrationReceiptsObserver::class);
        EventRoomArrangements::observe(EventRoomArrangementsObserver::class);
        EventAttachments::observe(EventAttachmentsObserver::class);
        EventRooms::observe(EventRoomsObserver::class);
        EventRoomAttachments::observe(EventRoomAttachmentsObserver::class);
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
        Services::observe(ServicesObserver::class);
        ServiceAttachments::observe(ServiceAttachmentsObserver::class);
        Users::observe(UsersObserver::class);
        UserUnavailability::observe(UserUnavailabilityObserver::class);
        UserRelationships::observe(UserRelationshipsObserver::class);
        Songs::observe(SongsObserver::class);
        SongAttachments::observe(SongAttachmentsObserver::class);
        PCOAttachments::observe(PCOAttachmentsObserver::class);
        Modules::observe(ModulesObserver::class);
        Permissions::observe(PermissionsObserver::class);
        Visitors::observe(VisitorsObserver::class);
    }
}