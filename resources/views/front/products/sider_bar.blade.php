<div class="col-lg-3 order-2 order-lg-1">
    <div class="hiraola-sidebar-catagories_area">
        <div class="category-module hiraola-sidebar_categories">
            <div class="category-module_heading">
                <h5>Categories</h5>
            </div>
            <div class="module-body">
                <ul class="module-list_item">
                    @foreach ($categories as $category)
                    <li>
                    <a href="{{$category->url}}">{{$category->category_name}}</a>
                        <ul class="module-sub-list_item">
                            @foreach ($category['subcategories'] as $subcategory)
                            <li>
                                <a href="{{$subcategory->url}}">{{$subcategory->category_name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="hiraola-sidebar_categories">
            <div class="hiraola-categories_title">
                <h5>Brand</h5>
            </div>
            <ul class="sidebar-checkbox_list">
                <li>
                    @foreach ($brands as $brand)
                        @if(!empty($brand->name))
                        <input type="checkbox" class="brand" name="brand[]" id="{{$brand->name}}" value="{{$brand->name}}"/><span style="margin-left:4px;"></span>{{$brand->name}} <br>
                    @endif
                    @endforeach
                </li>
            </ul>
        </div>
        <div class="hiraola-sidebar_categories">
            <div class="hiraola-categories_title">
                <h5>Sleeve</h5>
            </div>
            <ul class="sidebar-checkbox_list">
                <li>
                @foreach ($sleeveArray as $sleeve)
                    @if(!empty($sleeve->sleeve))
                        <input type="checkbox" class="sleeve" name="sleeve[]" id="{{$sleeve->sleeve}}" value="{{$sleeve->sleeve}}"/><span style="margin-left:4px;"></span>{{$sleeve->sleeve}} <br>
                    @endif
                @endforeach
                </li>
            </ul>
        </div>
        <div class="hiraola-sidebar_categories">
            <div class="hiraola-categories_title">
                <h5>Fabric</h5>
            </div>
            <ul class="sidebar-checkbox_list">
                <li>
                @foreach ($fabricArray as $fabric)
                    @if(!empty($fabric->fabric))
                        <input type="checkbox" class="fabric" name="fabric[]" id="{{$fabric->fabric}}" value="{{$fabric->fabric}}"/><span style="margin-left:4px;"></span>{{$fabric->fabric}} <br>
                    @endif
                @endforeach
                </li>
            </ul>
        </div>
        <div class="hiraola-sidebar_categories">
            <div class="hiraola-categories_title">
                <h5>Pattern</h5>
            </div>
            <ul class="sidebar-checkbox_list">
                <li>
                    @foreach ($patternArray as $pattern)
                        @if(!empty($pattern->pattern))
                            <input type="checkbox" class="pattern" name="pattern[]" id="{{$pattern->pattern}}" value="{{$pattern->pattern}}"/><span style="margin-left:4px;"></span>{{$pattern->pattern}} <br>
                        @endif
                    @endforeach
                </li>
            </ul>
        </div>

    </div>
</div>
