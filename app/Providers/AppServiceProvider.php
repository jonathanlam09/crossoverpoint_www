<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\AccountOfferings;
use App\Observers\AccountOfferingsObserver;

use App\Models\AccountOfferingCheques;
use App\Observers\AccountOfferingChequesObserver;

use App\Models\AuditLogs;
use App\Observers\AuditLogsObserver;

use App\Models\Users;
use App\Observers\UsersObserver;

use App\Models\Groups;
use App\Observers\GroupsObserver;

use App\Models\PCO;
use App\Observers\PCOObserver;

use App\Models\PCORequests;
use App\Observers\PCORequestsObserver;

use App\Models\PCOSongs;
use App\Observers\PCOSongsObserver;

use App\Models\PCORoles;
use App\Observers\PCORolesObserver;

use App\Models\Sermons;
use App\Observers\SermonsObserver;

use App\Models\SermonAttachments;
use App\Observers\SermonAttachmentsObserver;

use App\Models\Servants;
use App\Observers\ServantsObserver;

use App\Models\Events;
use App\Observers\EventsObserver;

use App\Models\Attendance;
use App\Observers\AttendanceObserver;

use App\Models\Songs;
use App\Observers\SongsObserver;

use App\Models\SongAttachments;
use App\Observers\SongAttachmentsObserver;

use App\Models\SongKeys;
use App\Observers\SongKeysObserver;

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
        Events::observe(EventsObserver::class);
        EventSignUps::observe(EventSignUpsObserver::class);
        EventAttachments::observe(EventAttachmentsObserver::class);
        Groups::observe(GroupsObserver::class);
        GroupMembers::observe(GroupMembersObserver::class);
        PCO::observe(PCOObserver::class);
        PCORoles::observe(PCORolesObserver::class);
        PCOSongs::observe(PCOSongsObserver::class);
        PCORequests::observe(PCORequestsObserver::class);
        Servants::observe(ServantsObserver::class);
        Sermons::observe(SermonsObserver::class);
        SermonAttachments::observe(SermonAttachmentsObserver::class);
        Users::observe(UsersObserver::class);
        Songs::observe(SongsObserver::class);
        SongKeys::observe(SongKeysObserver::class);
        SongAttachments::observe(SongAttachmentsObserver::class);
        PCOAttachments::observe(PCOAttachmentsObserver::class);
        Menus::observe(MenusObserver::class);
        Permissions::observe(PermissionsObserver::class);
        Visitors::observe(VisitorsObserver::class);
    }
}
