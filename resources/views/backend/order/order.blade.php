<x-backend>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1> <i class="icofont-list"></i> OrderList </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <a href="{{ route('backside.item.create') }}" class="btn btn-outline-primary">
                    <i class="icofont-plus icofont-1x"></i>
                </a>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        @if(session('successMsg') != NULL)
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> ✅ SUCCESS!</strong>
                                {{ session('successMsg') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped" id="sampleTable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th> # </th>
                                        <th> Date </th>
                                        <th> VoucherNo</th>
                                        <th> Total </th>
                                        <th> Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($orders as $order)
                            
                                    <tr>
                                        <td> {{$i++}} </td>
                                        <td> {{$order->orderdate}} </td>
                                        <td> {{$order->voucherno}} </td>
                                        <td> {{$order->total}} </td>
                                        <td> {{$order->status}} </td>
                                        
                                        <td>
                                            <a href="{{ route('orderdetail',$order->id) }}" class="btn btn-info">
                                                <i class="icofont-info icofont-1x"></i>
                                            </a>

                                       

                                            <form action="{{ route('backside.item.destroy',$order->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-outline-danger" type="submit" > 
                                                    <i class="icofont-close icofont-1x"></i>
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-backend>