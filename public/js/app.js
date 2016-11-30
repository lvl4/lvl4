$('.ui.dropdown')
  .dropdown()
;

$('.message .close')
  .on('click', function() {
    $(this)
      .closest('.message')
      .transition('fade')
    ;
  })
;

$('.menu .item')
  .tab()
;

$('select.dropdown')
  .dropdown()
;

$('.ui.accordion')
  .accordion()
;

function viewDecksModal()
{
  $('.ui.modal.viewDecks')
    .modal('show')
  ;  
}

$('#show-answer').click(function(){
  $('#card-answer').show();
  $('#show-answer').hide();
  $('.ratings').show();
});

function rate(deck_id, card_id, quality, user_id)
{


  // rate the current card
  // show some info to the console. rate this card!
  // console.log([deck_id, card_id, quality, user_id]);

  // rate the card
  
  $.post( "/api/rate", { deck_id: deck_id, card_id: card_id, quality: quality, user_id: user_id})
    .done(function( data ) {
      // console.log('RATED '+data);
      // get a random card from deck
      $.post( "/api/card/"+deck_id, function( data ) {
        data = $.parseJSON(data);
        console.log(data);
        if (data !== null){
          question = data.question;
          answer = data.answer;
          card_id = data.id;
          factor = parseFloat(data.factor);
          repeated = data.repeated;

          if(repeated == 1){
            quality0 = 1;
            quality1 = 1;
            quality2 = 1;
            quality3 = 1;
            quality4 = 1;
            quality5 = 1;
          }else if(repeated == 2){
            quality0 = 6;
            quality1 = 6;
            quality2 = 6;
            quality3 = 6;
            quality4 = 6;
            quality5 = 6;
          }else{
            quality0Factor = factor+(0.1-(5-0)*(0.08+(5-0)*0.02));
            quality1Factor = factor+(0.1-(5-1)*(0.08+(5-1)*0.02));
            quality2Factor = factor+(0.1-(5-2)*(0.08+(5-2)*0.02));
            quality3Factor = factor+(0.1-(5-3)*(0.08+(5-3)*0.02));
            quality4Factor = factor+(0.1-(5-4)*(0.08+(5-4)*0.02));
            quality5Factor = factor+(0.1-(5-5)*(0.08+(5-5)*0.02));

            quality0 = (repeated - 1) * (quality0Factor);
            quality1 = (repeated - 1) * (quality1Factor);
            quality2 = (repeated - 1) * (quality2Factor);
            quality3 = (repeated - 1) * (quality3Factor);
            quality4 = (repeated - 1) * (quality4Factor);
            quality5 = (repeated - 1) * (quality5Factor);
          }

          function calcDays(Quality, Repeated){
              if(Repeated == 1){
                quality0 = 1;
                quality1 = 1;
                quality2 = 1;
                quality3 = 1;
                quality4 = 1;
                quality5 = 1;
              }else if(Repeated == 2){
                quality0 = 6;
                quality1 = 6;
                quality2 = 6;
                quality3 = 6;
                quality4 = 6;
                quality5 = 6;
              }else{
                quality0Factor = factor+(0.1-(5-Quality)*(0.08+(5-Quality)*0.02));
                quality1Factor = factor+(0.1-(5-Quality)*(0.08+(5-Quality)*0.02));
                quality2Factor = factor+(0.1-(5-Quality)*(0.08+(5-Quality)*0.02));
                quality3Factor = factor+(0.1-(5-Quality)*(0.08+(5-Quality)*0.02));
                quality4Factor = factor+(0.1-(5-Quality)*(0.08+(5-Quality)*0.02));
                quality5Factor = factor+(0.1-(5-Quality)*(0.08+(5-Quality)*0.02));

                quality0 = (Repeated - 1) * (quality0Factor);
                quality1 = (Repeated - 1) * (quality1Factor);
                quality2 = (Repeated - 1) * (quality2Factor);
                quality3 = (Repeated - 1) * (quality3Factor);
                quality4 = (Repeated - 1) * (quality4Factor);
                quality5 = (Repeated - 1) * (quality5Factor);
              }

            switch(Quality) {
                case 0:
                    return quality0;
                    break;
                case 1:
                    return quality1;
                    break;
                case 2:
                    return quality2;
                    break;
                case 3:
                    return quality3;
                    break;
                case 4:
                    return quality4;
                    break;
                case 5:
                    return quality5;
                    break;
                default:
                    return 'ERROR';
            }
          }

          // set the new information
          $('#card-question').html(question);
          $('#card-answer').html(answer);
          $('.ratings').html(
            '<button onclick="rate('+deck_id+', '+card_id+', 0, '+user_id+')" class="ui button primary" data-tooltip="'+ Math.round(calcDays(0, repeated)) +' days" data-position="bottom center">0</button>'+
            '<button onclick="rate('+deck_id+', '+card_id+', 1, '+user_id+')" class="ui button primary" data-tooltip="'+ Math.round(calcDays(1, repeated)) +' days" data-position="bottom center">1</button>'+
            '<button onclick="rate('+deck_id+', '+card_id+', 2, '+user_id+')" class="ui button primary" data-tooltip="'+ Math.round(calcDays(2, repeated)) +' days" data-position="bottom center">2</button>'+
            '<button onclick="rate('+deck_id+', '+card_id+', 3, '+user_id+')" class="ui button primary" data-tooltip="'+ Math.round(calcDays(3, repeated)) +' days" data-position="bottom center">3</button>'+
            '<button onclick="rate('+deck_id+', '+card_id+', 4, '+user_id+')" class="ui button primary" data-tooltip="'+ Math.round(calcDays(4, repeated)) +' days" data-position="bottom center">4</button>'+
            '<button onclick="rate('+deck_id+', '+card_id+', 5, '+user_id+')" class="ui button primary" data-tooltip="'+ Math.round(calcDays(5, repeated)) +' days" data-position="bottom center">5</button>'
          );

          // hide answer ans show button and hide ratings
          $('#card-answer').hide();
          $('#show-answer').show();
          $('.ratings').hide();
        }else{
          // show no more cards
          $('#card-question').hide();
          $('#card-answer').hide();
          $('#show-answer').hide();
          $('.ratings').hide();
          $('#no-more').show();
        }


      });
  });
}