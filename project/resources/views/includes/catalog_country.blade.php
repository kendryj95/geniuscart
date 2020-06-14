        <div class="col-lg-3 col-md-6">
          <div class="left-area">
            <div class="filter-result-area">
            <div class="header-area">
              <h4 class="title">
                {{$langg->lang61}}
              </h4>
            </div>
            <div class="body-area">
              <form id="catalogForm" action="{{ route('front.country', [Request::route('country'), Request::route('city'), Request::route('neighborhood')]) }}" method="GET">
                @if (!empty(request()->input('search')))
                  <input type="hidden" name="search" value="{{ request()->input('search') }}">
                @endif
                @if (!empty(request()->input('sort')))
                  <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                @endif
                <ul class="filter-list">
                  @foreach ($countries_products as $element)
                  <li>
                    <div class="content">
                        <a href="{{route('front.country', Helper::slug($element['country_name']))}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link"> <i class="fas fa-angle-double-right"></i> {{$element['country_name']}}</a>
                        @if(!empty($country) && $country->id == $element['id'] && !empty($element['cities']))
                            @foreach ($element['cities'] as $key => $subelement)
                            <div class="sub-content open">
                              <a href="{{route('front.country', [Helper::slug($element['country_name']), Helper::slug($subelement['city_name'])])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link"><i class="fas fa-angle-right"></i>{{$subelement['city_name']}}</a>
                              @if(!empty($city) && $city->id == $subelement['id'] && !empty($subelement['nborhoods']))
                                @foreach ($subelement['nborhoods'] as $key => $childcat)
                                <div class="child-content open">
                                  <a href="{{route('front.country', [Helper::slug($element['country_name']), Helper::slug($subelement['city_name']), Helper::slug($childcat['name'])])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link"><i class="fas fa-caret-right"></i> {{$childcat['name']}}</a>
                                </div>
                                @endforeach
                              @endif
                            </div>
                            @endforeach

                          </div>
                        @endif


                  </li>
                  @endforeach

                </ul>


                <div class="price-range-block">
                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                    <div class="livecount">
                      <input type="number" min=0  name="min"  id="min_price" class="price-range-field" />
                      <span>{{$langg->lang62}}</span>
                      <input type="number" min=0  name="max" id="max_price" class="price-range-field" />
                    </div>
                  </div>

                  <div class="form-group">
                    <select name="category_id" id="categories" onchange="countryOptionsFilters('subcategories',this.value)" class="form-control">
                      <option value=""> {{ $langg->lang691 }} </option>
                      @foreach ($categories_products as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <select name="subcategory_id" id="subcategories" onchange="countryOptionsFilters('childcategories',this.value)" class="form-control">
                      <option value=""> {{ $langg->lang639 }} </option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <select name="childcategory_id" id="childcategories" class="form-control">
                      <option value="">{{ $langg->lang641 }}</option>
                    </select>
                  </div>

                  <button class="filter-btn" type="submit">{{$langg->lang58}}</button>
              </form>
            </div>
            </div>


           {{-- @if ((!empty($cat) && !empty(json_decode($cat->attributes, true))) || (!empty($subcat) && !empty(json_decode($subcat->attributes, true))) || (!empty($childcat) && !empty(json_decode($childcat->attributes, true))))

              <div class="tags-area">
                <div class="header-area">
                  <h4 class="title">
                      Filters
                  </h4>
                </div>
                <div class="body-area">
                  <form id="attrForm" action="{{route('front.country', [Request::route('country'), Request::route('city'), Request::route('neighborhood')])}}" method="post">
                    <ul class="filter">
                      <div class="single-filter">
                        @if (!empty($cat) && !empty(json_decode($cat->attributes, true)))
                          @foreach ($cat->attributes as $key => $attr)
                            <div class="my-2 sub-title">
                              <span><i class="fas fa-arrow-alt-circle-right"></i> {{$attr->name}}</span>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check ml-0 pl-0">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($subcat) && !empty(json_decode($subcat->attributes, true)))
                          @foreach ($subcat->attributes as $key => $attr)
                          <div class="my-2 sub-title">
                            <span><i class="fas fa-arrow-alt-circle-right"></i> {{$attr->name}}</span>
                          </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check  ml-0 pl-0">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($childcat) && !empty(json_decode($childcat->attributes, true)))
                          @foreach ($childcat->attributes as $key => $attr)
                          <div class="my-2 sub-title">
                            <span><i class="fas fa-arrow-alt-circle-right"></i> {{$attr->name}}</span>
                          </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check  ml-0 pl-0">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif
                      </div>
                    </ul>
                  </form>
                </div>
              </div>
            @endif --}}


            @if(!isset($vendor))

            {{-- <div class="tags-area">
                <div class="header-area">
                    <h4 class="title">
                        {{$langg->lang63}}
                    </h4>
                  </div>
                  <div class="body-area">
                    <ul class="taglist">
                      @foreach(App\Models\Product::showTags() as $tag)
                      @if(!empty($tag))
                      <li>
                        <a class="{{ isset($tags) ? ($tag == $tags ? 'active' : '') : ''}}" href="{{ route('front.tag',$tag) }}">
                            {{ $tag }}
                        </a>
                      </li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
            </div> --}}


            @else

            <div class="service-center">
              <div class="header-area">
                <h4 class="title">
                    {{ $langg->lang227 }}
                </h4>
              </div>
              <div class="body-area">
                <ul class="list">
                  <li>
                      <a href="javascript:;" data-toggle="modal" data-target="{{ Auth::guard('web')->check() ? '#vendorform1' : '#comment-log-reg' }}">
                          <i class="icofont-email"></i> <span class="service-text">{{ $langg->lang228 }}</span>
                      </a>
                  </li>
                  <li>
                        <a href="tel:+{{$vendor->shop_number}}">
                          <i class="icofont-phone"></i> <span class="service-text">{{$vendor->shop_number}}</span>
                        </a>
                  </li>
                </ul>
              <!-- Modal -->
              </div>

              <div class="footer-area">
                <p class="title">
                  {{ $langg->lang229 }}
                </p>
                <ul class="list">


              @if($vendor->f_check != 0)
              <li><a href="{{$vendor->f_url}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
              @endif
              @if($vendor->i_check != 0)
              <li><a href="{{$vendor->i_url}}" target="_blank"><i class="fab fa-google"></i></a></li>
              @endif
              @if($vendor->t_check != 0)
              <li><a href="{{$vendor->t_url}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
              @endif
              @if($vendor->w_check != 0)
              <li><a href="{{$vendor->w_url}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
              @endif


                </ul>
              </div>
            </div>


            @endif


          </div>
        </div>
