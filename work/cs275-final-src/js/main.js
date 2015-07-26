$(function() {

  var App = {};

  App.$button_add = $('#add-bar');
  App.$delete_buttons = $('.delete-bar');
  App.$address_buttons = $('.update-address');

  App.$bars_table = $('#bars-detailed');

  App.getBars = function() {
    App.$bars_table.empty();
    $.get('api/bars_detailed.php', function(data) {
//       data.shift();
      console.log(data);
      data.forEach(function(row) {
        var $tr = $('<tr></tr>');
        Object.keys(row).forEach(function(key) {
          if (key=='number' || key=='street' || key=='state' || key=='city'){
            $tr.append('<td><input class="address" name="'+
              key +'" type="text" value="'+row[key]+'"></td>');
          } else {
            $tr.append('<td>'+row[key]+'</td>') ;
          }
        });
        $tr.append('<td><button class="update-address pure-button button-success"'+
          ' name="'+row.bar_name+'">change</button></td>')
        $tr.append('<td><button class="delete-bar pure-button button-error"'+
          ' name="'+row.bar_name+'">delete</button></td>');
        App.$bars_table.append($tr);
      });
      App.$delete_buttons = $('.delete-bar');
      App.$delete_buttons.on('click', function(e) {
          e.preventDefault();
          var barName = $(this).attr('name');
          App.deleteBar(barName);
      });
      App.$address_buttons = $('.update-address');
      App.$address_buttons.on('click', function(e) {
          e.preventDefault();
          var $tr = $(this).parents('tr');
          var bar = $tr.children(":first").text(); 
          var number = $tr.find('[name="number"]').val();
          var street = $tr.find('[name="street"]').val();
          var city = $tr.find('[name="city"]').val();
          var state = $tr.find('[name="state"]').val();
          App.updateAddress({ bar: bar, number: number, street: street, city: city, state: state});
      });
    }, 'json');
  };

  App.updateAddress = function(data) {
    $.post('api/add_location.php', data)
      .done(function(){
        alert('success');
        App.getBars();
      })
      .fail(function(){
        alert('something went wrong');
      });
  }

  App.deleteBar = function(name) {
    $.post('api/delete_bar.php', {bar: name})
      .done(function(){
        alert('success');
        App.getBars();
      })
      .fail(function(){
        alert('something went wrong');
      });
  }

  App.init = function() {
    this.$button_add.on('click', function(e) {
        e.preventDefault();
        var name = $('input[name="name"]').val();
        var quality = $('input[name="drink_quality"]').val();
        $.post('api/add_bar.php', {name: name, drink_quality: quality})
          .done(function(data) {
          App.getBars();
          alert('success');
        });
    });


    this.getBars();
  };

  App.init();


});
