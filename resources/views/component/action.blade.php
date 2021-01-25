 @if ($list_item)
    @php
        // $user = request()->user()->hasRole('admin' ,'project-manager');
        
        $filtered = collect([]) ;

        $user = true ;

        // if(!$user) {

        //     $filtered = collect(collect($list_item)->toArray())->filter(function ($value, $key) {
        //         return $value['permission'] == true;
        //     });

        // }

    @endphp
    <div class="text-right">
        @if($filtered->count() > 0 || $user)
            <span class="dropdown ">
                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-h text-blue " style="font-size: 22px;"></i>
                </a>
                @if(isset($list_item))
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                        @foreach ($list_item as $item)
                            @if ($item->get('permission') != false || $user)
                                <a class="dropdown-item {{ $item->get('target',null) ? 'call-model' : '' }} {{ $item->get('class',null) }}" 
                                    @if($item->get('target' ,null))
                                        data-target-modal="{{ $item->get('target') }}" 
                                    @endif
                                    data-id={{ $item->get('id',null) }}  
                                    data-url="{{ $item->get('action' , 'javaqscrip:void(0)') }}"
                                    href="{{ $item->get('action' , 'javaqscrip:void(0)') }}" target={{ $item->get('target_blank',null) }} >
                                    <i class="{{ $item->get('icon') }} pr-2" ></i>{{ $item->get('text') }}
                                </a>                    
                            @endif
                        @endforeach
                    </div>

                @endif
            </span>
        @endif
    </div>
@endif
