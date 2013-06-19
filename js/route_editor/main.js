require.config({
    paths : {
        //create alias to plugins (not needed if plugins are on the baseUrl)
        async: '/js/libs/require/async'
    }
});

require([
  // Load our app module and pass it to our definition function
  'editor'
], function(Editor){

    var current_route_id = +$('#routes_editor').data('route-id');
    var RouteEditorApp = new Editor({editedRouteId: current_route_id});
});