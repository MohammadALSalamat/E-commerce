   <?php
    use App\products; // use this line to call the function cartCount from model products jsut as below:-

?>
   <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-productsr-->
            <div class="panel panel-default">
                @foreach ($Showcategory as $MainCat)
                @if ($MainCat->status == "1")
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <h4 class='panel-title'>
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$MainCat->name}}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{ $MainCat->name }}
                            </a>
                        </h4>
                    </div>
                    <div id="{{$MainCat->name}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach ($MainCat->frontCategory as $subCat)
                                @if ($subCat->status == "1")
                                <li><a href="{{asset('/product/'.$subCat->url)}}"> {{$subCat->name}}</a>
                                    <span ID="sidebar">
                                        <?php echo $countCategory =products::CategoryCount($subCat->id) ;?> </span>
                                </li>
                                @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>
                @endif
                @endforeach
            </div>
        </div>

    </div>
