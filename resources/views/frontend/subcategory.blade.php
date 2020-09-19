<x-frontend>

  <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg subtitle">
        <div class="container">
            <div class="row">

                @foreach ($items as $item)
                @php 
                $name=$item->name;
                @endphp
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                       <h2> {{$name}}</h2>
                       
                   </div>
               </div>
               @endforeach

           </div>
       </div>
   </section>
   <!-- Breadcrumb Section End -->

   <!-- Product Section Begin -->
   <section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product__discount">

                    @foreach ($items as $item)
                    @php 
                    $name=$item->name;
                    @endphp
                    <div class="section-title product__discount__title">
                        <h2>{{$name}}' Items</h2>
                    </div>
                    @endforeach
                    <div class="row">
                        @if($items->count()>0)
                        <div class="product__discount__slider owl-carousel">
                           @foreach($items as $item)
                           @php
                           $id=$item->id;
                           $codeno=$item->codeno;
                           $name=$item->name;
                           $unitprice=$item->price;
                           $discount=$item->discount;
                           $photos=json_decode($item->photo);

                           $photo=$photos[0];
                           @endphp
                           <div class="col-lg-4">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg"
                                data-setbg="{{asset($photo)}}">

                                <ul class="product__item__pic__hover">
                                    <li>
                                      <a href="{{route('detail',$id)}}">


                                        <i class="fa fa-eye"></i></a></li>

                                    <li><a href="javascript:void(0)" class="addtocartBtn"
                                        data-id="{{$id}}"
                                        data-name="{{$name}}"
                                        data-codeno="{{$codeno}}"
                                        data-unitprice="{{$unitprice}}"
                                        data-discount="{{$discount}}"
                                        data-photo="{{$photo}}">




                                        <i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                              
                                <h5>
                                 <a href="#">{{Str::limit($name,20)}}</a>


                             </h5>
                             @if($discount)

                             <div class="product__item__price">{{$discount}}Ks <span>{{$unitprice}}Ks</span> 
                             </div>
                             @else
                             <div class="product__item__price">{{$unitprice}}Ks </div>
                             @endif
                         </div>
                     </div>
                 </div>
                 @endforeach                         
             </div>
             @else
             <div class="col-6">
                <img src="{{asset('tenor.gif')}}">
            </div>
            <div class="col-6">
                <img src="{{asset('ww.gif')}}">
            </div>
            @endif
        </div>
    </div>
</div>
</div>
</div>
</section>
<!-- Product Section End -->


</x-frontend>