<ul class="nav main-submenu show-route">
    <li class="dropdown">
        <label>Тип маршрута</label>
        <select class="span2 typeSelect">
            <?php foreach ($allRoutes as $type) :?>
                <option class="ddm" data-type-id="<?php echo $type->id ?>"><span class="label"><?php echo $type->name ?></span></option>
            <?php endforeach ?>
        </select>
    </li>
    <li class="dropdown">
        <label>Маршрут</label>
        <select class="span2 routeOptions" >
        </select>
    </li>
    <li>
        <label class="checkbox">
            <input type="checkbox" class="showStopsCheckbox" checked> Показывать остановки
        </label>
        <button class="btn btn-success" id="remember-route" type="button">Запомнить</button>
    </li>
</ul>

<ul class="nav main-submenu search-route">
    <li class="dropdown">
        <div class="control-group">
            <label>От</label>
            <input type="text" placeholder="проспект Победы 15" id="dirFrom">
            <button class="btn btn-info selectFromOnMap" type="button">Нажмите кнопку и выберите место на карте</button>
        </div>
    </li>
    <li class="dropdown">
        <div class="control-group">
            <label>До</label>
            <input type="text" placeholder="проспект Победы 66" id="dirTo">
            <button class="btn btn-info selectToOnMap" type="button">Нажмите кнопку и выберите место на карте</button>
        </div>
    </li>
    <li>
        <label class="checkbox">
            <input type="checkbox" class="showStopsCheckbox" checked> Показывать остановки
        </label>
    </li>
</ul>

<ul class="nav main-submenu my-route">
    <li class="dropdown">
        <div class="control-group">
            <label>Маршрут</label>
            <select class="span2 myRoutes">
            </select>
        </div>
    </li>
</ul>

<script>
    var viewer_id;
    console.log("init_bebe")
    window.onload = (function(){
        VK.init(function() {

            var parts=document.location.search.substr(1).split('&');

            var flashVars={}, curr;

            for (i=0; i<parts.length; i++) {
                curr = parts[i].split('=');
                flashVars[curr[0]] = curr[1];
            }

            viewer_id = flashVars['viewer_id'];

            $('body').attr("viewer-id", viewer_id)
        })
    })
</script>