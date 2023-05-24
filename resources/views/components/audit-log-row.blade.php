@props(['auditLog'])

<tr data-toggle="collapse" data-target={{"#". $auditLog->id}} class="accordion-toggle">
    <td><button class="btn bg-ligt"><span class="glyphicon glyphicon-eye-open text-dark">&times;</span></button></td>
    <td scope="1">{{str_replace('App\Models\\', '', $auditLog->model_type)}}</td>
    <td>{{$auditLog->model_id}}</td>
    <td>{{$auditLog->event}}</td>
    <td>{{$auditLog->user->username}}</td>
    <td>{{$auditLog->created_at }}</td>
</tr>

@if($auditLog->new_values != null)
    <tr>
        <td colspan="12" class="hiddenRow">
            <div class="accordian-body collapse" id={{$auditLog->id}}>
                <table class="table table-striped">
                    <thead>
                        <tr class="info">
                            <th>Old attributes</th>
                            <th>New Attributes</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($auditLog->new_values ?? [] as $attribute => $value)
                            <tr data-toggle="collapse" class="accordion-toggle" data-target={{"#". $auditLog->id}}>
                                @if(json_encode($auditLog->old_values[$attribute] ?? null) 
                                    != json_encode($auditLog->new_values[$attribute]))
                                    @if(!($attribute == 'created_at' || $attribute == 'updated_at'))
                                        
                                        <td class="p-l-3 p-r-3" style="max-width: 200px">
                                            @if($auditLog->old_values != null)
                                                <p style="word-wrap:break-word"><b>{{ $attribute }}: </b> {{ json_encode($auditLog->old_values[$attribute]) }}</p>
                                            @endif
                                        </td>
                                        <td class="p-l-3 p-r-3" style="max-width: 200px">
                                            <p style="word-wrap:break-word"><b>{{ $attribute }}: </b> {{ json_encode($value) }}</p>
                                        </td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </td>
    </tr>
@endif