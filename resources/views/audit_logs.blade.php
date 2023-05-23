<x-layout>
    <!-- Audits -->

    <div class="container">
        <div class="col-md-12">
            <h2 class="panel-heading text-center p-4">
                Audit Logs
            </h2>
            <div class="dis-flex flex-c m-t-20 m-b-20">
                <form action={{route('audit_logs.index')}} method="GET">
                    <label for="user" class="m-r-5">User: </label>
                    <select id='user' class="form-select form-select-lg mb-3 h-full" aria-label="users" name="user">
                        <option value="" selected>Open this select menu</option>
                        @forelse ($users as $user)
                            <option value={{$user->id}} {{request('user') == $user->id ? 'selected': ''}}>
                                 {{$user->username}}
                            </option>
                        @empty
                        @endforelse
                      </select>
                    <label for="model" class="m-l-15 m-r-5">Model: </label>
                    <select id='model' class="form-select form-select-lg mb-3 h-full" aria-label="models" name='model'>
                        <option value="" selected>Open this select menu</option>
                        @forelse ($models as $key => $value)
                            <option value={{str_replace('App\Models\\', '', $value)}} 
                                {{request('model') == str_replace('App\Models\\', '', $value) ? 'selected': ''}}>
                                {{str_replace('App\Models\\', '', $value)}}
                            </option>
                        @empty
                        @endforelse
                      </select>
                    <label for="event" class="m-l-15 m-r-5">Event: </label>
                    <select id='event' class="form-select form-select-lg mb-3 h-full" aria-label="events" name='event'>
                        <option value="" selected>Open this select menu</option>
                        <option value="create" {{request('event') == 'create' ? 'selected': ''}}>
                            Create
                        </option>
                        <option value="update" {{request('event') == 'update' ? 'selected': ''}}>
                            Update
                        </option>
                        <option value="delete" {{request('event') == 'delete' ? 'selected': ''}}>
                            Delete
                        </option>
                      </select>
                      <button type='submit' class="btn btn-primary h-full m-l-15">Filter</button>
                </form>    
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                            <th></th>
                            <th>Model Type</th>
                            <th>Model Id</th>
                            <th>Event</th>
                            <th>User Id</th>
                            <th>Created At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($auditLogs as $auditLog)
                                <x-audit-log-row :auditLog="$auditLog" />
                            @empty
                                <tr>No audits found</tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>


</x-layout>