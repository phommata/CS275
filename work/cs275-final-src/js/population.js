$(function() {

  var App = {};

  var $bars_table = $('#population-table');

  App.getBars = function() {
    $.get('api/bar_population.php', function(data) {
      console.log(data);
      data.forEach(function(row) {
        var $tr = $('<tr></tr>');
        Object.keys(row).forEach(function(key) {
          $tr.append('<td>'+row[key]+'</td>') ;
        });
        $bars_table.append($tr);
      });
    }, 'json');
  };
  App.getBars();

});
