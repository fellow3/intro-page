require(['jquery', 'underscore', 'bootstrap'],
        function($, _) {

            var $app = $('#survey_app');
            $('a#next', $app).click(function(e) {
                    displayDetail($app);
            });
            var displayDetail = function($el, template_args) {
                var template = $('#intro_2_template').html();
                $el.empty();
                $el.removeClass('intro-centered');
                $el.append(template);
                $('a#next', $el).click( function(e) {
                    displayThank($el);
                });
            };

            var displayThank = function($el) {
                var template = $('#intro_last').html();
                $el.empty();
                $el.addClass('intro-centered');
                $el.append(template);
            }
        }
   );
