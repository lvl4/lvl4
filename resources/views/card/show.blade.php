

@extends('layouts.app')

@section('title')
    {{ $deck->name }}
@endsection

@section('content')
  <div class="sixteen wide column">
    <div class="ui fluid card">
      <div class="content">

        <div style="display:none;" id="no-more" class="ui success icon message">
          <i class="check circle  icon"></i>
          <div class="content">
            <div class="header">
              That's it for today!
            </div>
            <p>Depending on how you rated the questions, check back tomorrow for your next session.</p>
          </div>
        </div>
        <center>
          <div id="loader" class="ui active loader"></div>
          <h1 id="card-question">
            
          </h1>
          <h1 style="display: none;" id="card-answer">
            
          </h1>

          <button style="display: none;" id="show-answer" class="ui button primary">Show answer</button>

          <div style="display:none;" class="ratings">

          </div>
        </center>
      </div>
    </div>
  </div>

  <script>
    var deck_id = {{ $deck->id }};
    var user_id = {{ Auth::user()->id }};
  </script>
@endsection

@section('scripts')
  <script>
    $.post( "/api/card/"+deck_id, function( data ) {
      data = $.parseJSON(data);

      if(data !== null)
      {
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
        $('#loader').hide();
        $('#show-answer').show();
        $('#card-question').html(question);
        $('#card-answer').html(answer);
        $('.ratings').html(
          '<button onclick="rate('+deck_id+', '+card_id+', 0, '+user_id+')" class="ui button primary"  data-tooltip="'+ Math.round(calcDays(0, repeated)) +' days" data-position="bottom center" >0</button>'+
          '<button onclick="rate('+deck_id+', '+card_id+', 1, '+user_id+')" class="ui button primary"  data-tooltip="'+ Math.round(calcDays(1, repeated)) +' days" data-position="bottom center" >1</button>'+
          '<button onclick="rate('+deck_id+', '+card_id+', 2, '+user_id+')" class="ui button primary"  data-tooltip="'+ Math.round(calcDays(2, repeated)) +' days" data-position="bottom center" >2</button>'+
          '<button onclick="rate('+deck_id+', '+card_id+', 3, '+user_id+')" class="ui button primary"  data-tooltip="'+ Math.round(calcDays(3, repeated)) +' days" data-position="bottom center" >3</button>'+
          '<button onclick="rate('+deck_id+', '+card_id+', 4, '+user_id+')" class="ui button primary"  data-tooltip="'+ Math.round(calcDays(4, repeated)) +' days" data-position="bottom center" >4</button>'+
          '<button onclick="rate('+deck_id+', '+card_id+', 5, '+user_id+')" class="ui button primary"  data-tooltip="'+ Math.round(calcDays(5, repeated)) +' days" data-position="bottom center" >5</button>'
        );
      }else{
        $('#loader').hide();
        $('#card-question').hide();
        // show no more cards
        $('#no-more').show();
      }

    });
  </script>
@endsection
