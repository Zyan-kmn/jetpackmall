<x-frontend>

   <section class="breadcrumb-section set-bg subtitle">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2> Promotion </h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="search_section" > 
     <div class="row"  id="searchMenu" >


        </div>
</div>
</div>

<!-- Product Section Begin -->
<section class="product spad" id="promotion_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0"> A - Z </option>
                                    <option value="0"> Z - A </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">

                                <h6><span>{{$discountcount}}</span> Products found</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                   @foreach($discountitems as $discountitem)
                   @php
                   $photos=json_decode($discountitem->photo);
                   $photo=$photos[0];
                   $id=$discountitem->id;
                   $name=$discountitem->name;
                   $codeno=$discountitem->codeno;
                   $unitprice=$discountitem->price;
                   $discount=$discountitem->discount;

                   @endphp
                   <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{asset($photo)}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="{{route('detail',$id)}}"><i class="fa fa-eye"></i></a></li>

                                <li><a href="javascript:void(0)" 
                                   class="addtocartBtn"
                                   data-id="{{$id}}"
                                   data-name="{{$name}}"
                                   data-codeno="{{$codeno}}"
                                   data-unitprice="{{$unitprice}}"
                                   data-discount="{{$discount}}"
                                   data-photo="{{$photo}}">




                                   <i class="fa fa-shopping-cart"></i></a></i></a></li>
                               </ul>
                           </div>
                           <div class="product__discount__item__text">
                            <h5><a href="#">{{$name}}</a></h5>
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

            {!! $discountitems->links() !!}
        </div>
    </div>
</div>
</section>

</x-frontend>