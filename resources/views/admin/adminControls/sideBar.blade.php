<div class="col-md-3 mb-4">
  <div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0 text-center">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        MENU &#9776;
        </button>
        </h5>
      </div>
      
      <div id="collapseOne" class="collapse show admin-menu" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body p-0">
          
          {{-- LIST START --}}
          <div class="list-group">
            
            <a href="/admin" class="list-group-item list-group-item-action"><i class="fas fa-chart-line"></i> Dashboard</a>
            
            <a href="/admin/{{ Auth::user()->id }}/edit"
              class="
              {{ Route::currentRouteName() == 'admin.edit' ? 'active' : '' }}
              list-group-item list-group-item-action">
              <i class="fas fa-user-circle"></i> Admin Profile
            </a>
            
            <a href="/viewUsers"
              class="
              {{ Route::currentRouteName() == 'viewUsers' ? 'active' : '' }}
              list-group-item list-group-item-action">
              <i class="fas fa-users"></i> All Users <span class="badge badge-dark float-right mt-1">{{ $totalNormalUsers }}</span>
            </a>
            
            @if(Auth::user()->role->id == 3)
                <a href="/viewAdmins"
                  class="
                  {{ Route::currentRouteName() == 'viewAdmins' ? 'active' : '' }}
                  list-group-item list-group-item-action">
                  <i class="fas fa-users"></i> Manage Admins <span class="badge badge-dark float-right mt-1">{{ $totalAdminUsers }}</span>
                </a>
            @endif
            
            <a href="/policyDetailsUpate"
              class="
              {{ Route::currentRouteName() == 'policyDetailsUpate' ? 'active' : '' }}
              list-group-item list-group-item-action">
              <i class="fas fa-paperclip"></i> Policy Details Update <span class="badge badge-dark float-right mt-1">{{ $totalDetails }}</span>
            </a>
            
            <a href="/renewals"
              class="
              {{ Route::currentRouteName() == 'renewals' ? 'active' : '' }}
              list-group-item list-group-item-action">
              <i class="fas fa-file-upload"></i> Renewal Requests <span class="badge badge-dark float-right mt-1">{{ $userRenewals }}</span></span>
            </a>
            
            <!--<a href="/invoice"-->
            <!--  class="-->
            <!--  {{ Route::currentRouteName() == 'invoice.index' ? 'active' : '' }}-->
            <!--list-group-item list-group-item-action"><i class="fas fa-copy"></i> All Invoices</a>-->
            
            <!--<a href="/invoice/create"-->
            <!--  class="-->
            <!--  {{ Route::currentRouteName() == 'invoice.create' ? 'active' : '' }}-->
            <!--list-group-item list-group-item-action"><i class="fas fa-plus"></i> Add New Invoice</a>-->

            <!--<a href="/contract"-->
            <!--  class="-->
            <!--  {{ Route::currentRouteName() == 'contract.index' ? 'active' : '' }}-->
            <!--list-group-item list-group-item-action"><i class="fas fa-file-signature"></i> All Contracts</a>-->

            <!--<a href="/contract/create"-->
            <!--  class="-->
            <!--  {{ Route::currentRouteName() == 'contract.create' ? 'active' : '' }}-->
            <!--list-group-item list-group-item-action"><i class="fas fa-plus"></i> Add New Contract</a>-->
            
            <!--<a href="/attachment"-->
            <!--  class="-->
            <!--  {{ Route::currentRouteName() == 'attachment.index' ? 'active' : '' }}-->
            <!--list-group-item list-group-item-action"><i class="fas fa-paperclip"></i> All Attachments</a>-->

            <!--<a href="/attachment/create"-->
            <!--  class="-->
            <!--  {{ Route::currentRouteName() == 'attachment.create' ? 'active' : '' }}-->
            <!--list-group-item list-group-item-action"><i class="fas fa-plus"></i> Add New Attachment</a>-->

            <!--<a href="/userInvoices"-->
            <!--  class="-->
            <!--  {{ Route::currentRouteName() == 'invoicesByUsers' ? 'active' : '' }}-->
            <!--list-group-item list-group-item-action"><i class="fas fa-copy"></i> Documents From User</a>-->
            
            <!--<a href="/claim"-->
            <!--  class="-->
            <!--  {{ Route::currentRouteName() == 'claims' ? 'active' : '' }}-->
            <!--list-group-item list-group-item-action"><i class="fas fa-money-bill-alt"></i> Claim</a>-->
            
            
          </div>
          {{-- LIST END --}}
        </div>
      </div>
    </div>
  </div>
  
</div>