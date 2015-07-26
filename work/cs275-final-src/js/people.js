$(function() {

  var App = {};

  App.$people_table = $('#people-table');
  App.$btnAddPerson = $('#add-person');
  App.$delete_buttons = $('.delete-person');
  App.$selectBar = $('#select-bar');
  App.$selectPerson = $('#select-person');
  App.$selectType = $('#select-type');
  App.$btnAddDrink = $('#add-drink');

  App.getPeople = function() {
    App.$people_table.empty();
    App.$selectPerson.empty();
    $.get('api/people.php', function(data) {
      console.log(data);
      data.forEach(function(row) {
        var $tr = $('<tr></tr>');
        Object.keys(row).forEach(function(key) {
          $tr.append('<td>'+row[key]+'</td>') ;
        });
        $tr.append('<td><button class="delete-person pure-button button-error"'+
          ' fname="'+row.fname+'" lname="'+row.lname+'">delete</button></td>');
        App.$people_table.append($tr);
        App.$selectPerson.append('<option>'+row.fname+' '+row.lname+'</option>');
      });

      App.$delete_buttons = $('.delete-person');
      App.$delete_buttons.on('click', function(e) {
          e.preventDefault();
          var fname = $(this).attr('fname');
          var lname = $(this).attr('lname');
          App.deletePerson({fname: fname, lname: lname});
      });

    }, 'json');
  };


  App.deletePerson = function(data) {
    $.post('api/delete_person.php', data)
      .done(function(){
        alert('success');
        App.getPeople();
      })
      .fail(function(){
        alert('something went wrong');
      });
  }

  App.addPerson = function(data) {
    $.post('api/add_person.php', data)
      .done(function(){
        alert('success');
        App.getPeople();
      })
      .fail(function(){
        alert('something went wrong');
      });
  }

  App.addDrink = function(data) {
    $.post('api/add_drink.php', data)
      .done(function(){
        alert('success');
        App.getPeople();
      })
      .fail(function(){
        alert('something went wrong');
      });

  }

  App.init = function() {
    $.get('api/bars_detailed.php', function(data) {
      var barNames = [];
      data.forEach(function(bar) {
        barNames.push(bar.bar_name);
      })
      barNames.forEach(function(bar) {
        App.$selectBar.append('<option>'+bar+'</option>');
      })
    }, 'json');

    $.get('api/drink_type.php', function(data) {
      var drinkTypes = [];
      data.forEach(function(type) {
        drinkTypes.push(type.name);
        App.$selectType.append('<option>'+type.name+'</option>');
      })
    }, 'json');

    this.$btnAddPerson.on('click', function(e) {
        e.preventDefault();
        var fname = $('input[name="fname"]').val();
        var lname = $('input[name="lname"]').val();
        App.addPerson({fname: fname, lname: lname})
    })

    this.$btnAddDrink.on('click', function(e) {
        e.preventDefault();
        var data = {};
        $form = $(this).parents('form');
        person = $form.find('select[name="drink-person"]').val();
        data.fname = person.split(' ')[0];
        data.lname = person.split(' ')[1];
        data.bar = $form.find('select[name="drink-bar"]').val();
        data.drinkType = $form.find('select[name="drink-type"]').val();
        data.price = $form.find('input[name="drink-cost"]').val();
        data.time = $form.find('input[name="drink-time"]').val();
        App.addDrink(data);
    })

    this.getPeople();
  }
  App.init();
});
