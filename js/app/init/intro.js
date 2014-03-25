require(['jquery', 'underscore', 'text!../../resources/list_countries.json', 'bootstrap'],
        function($, _, countriesArray) {
            var countries = JSON.parse(countriesArray);

            $(function() {
                var datalist = countries.map(function(c) {
                    return '<option value="' + c +'">';
                });
                $('body').append($('<datalist/>', {id:'countries'}).html(datalist.join('')));
            });
            var $app = $('#survey_app');
            $('a#next', $app).click(function(e) {
                displayDetail($app);
            });
            $('form', $app).submit(function(e) {
                e.preventDefault();
                displayDetail($app);
            });
            var displayDetail = function($el, template_args) {
                var template = _.template($('#intro_2_template').html());
                var email = $('input[name=email]').val().trim();
                submitEmail(email);
                $el.empty();
                $el.removeClass('intro-centered');
                $el.append(template({"email": email}));
                $('a#next', $el).click( function(e) {
                    updateDetail($el);
                    displayThank($el);
                });
            };

            var displayThank = function($el) {
                var template = $('#intro_last').html();
                $el.empty();
                $el.addClass('intro-centered');
                $el.append(template);
            }
            var userid;

            var submitEmail = function(email) {
                var json = JSON.stringify({ email: email });              
              $.ajax({
                    url: '/api/user_survey',
                    method: 'POST',
                    type: 'application/json',
                    data: json,
                    success: function(resp) {
                        userid = resp['id'];
                    }
                });
            };

            var updateDetail = function($el) {
                var inputs = $('input', $el);
                var data = {};
                inputs.each( function() {
                    data[this.getAttribute('id')] = $(this).val().trim();
                });
                
                $.ajax({
                    url: '/api/user_survey/'+userid,
                    method: 'PUT',
                    type: 'application/json',
                    data: JSON.stringify(data),
                    success: function(resp) {
                    }
                });

            };
        }
   );
