/**
 * Plugin: jquery.zWeatherFeed
 * 
 * Version: 1.2.1
 * (c) Copyright 2011-2013, Zazar Ltd
 * 
 * Description: jQuery plugin for display of Yahoo! Weather feeds
 * 
 * History:
 * 1.2.1 - Handle invalid locations
 * 1.2.0 - Added forecast data option
 * 1.1.0 - Added user callback function
 *         New option to use WOEID identifiers
 *         New day/night CSS class for feed items
 *         Updated full forecast link to feed link location
 * 1.0.3 - Changed full forecast link to Weather Channel due to invalid Yahoo! link
 Add 'linktarget' option for forecast link
 * 1.0.2 - Correction to options / link
 * 1.0.1 - Added hourly caching to YQL to avoid rate limits
 *         Uses Weather Channel location ID and not Yahoo WOEID
 *         Displays day or night background images
 *
 **/

(function($) {

    $.fn.weatherfeed = function(locations, options, fn) {

        // Set plugin defaults
        var defaults = {
            unit: 'c',
            image: true,
            country: false,
            highlow: true,
            wind: true,
            humidity: false,
            visibility: false,
            sunrise: false,
            sunset: false,
            forecast: false,
            link: true,
            showerror: true,
            linktarget: '_self',
            woeid: false
        };
        var options = $.extend(defaults, options);
        var row = 'odd';

        // Functions
        return this.each(function(i, e) {
            var $e = $(e);

            // Add feed class to user div
            if (!$e.hasClass('weatherFeed'))
                $e.addClass('weatherFeed');

            // Check and append locations
            if (!$.isArray(locations))
                return false;

            var count = locations.length;
            if (count > 10)
                count = 10;

            var locationid = '';

            for (var i = 0; i < count; i++) {
                if (locationid !== '')
                    locationid += ',';
                locationid += "'" + locations[i] + "'";
            }

            // Cache results for an hour to prevent overuse
            now = new Date();

            // Select location ID type
            var queryType = options.woeid ? 'woeid' : 'location';

            // Create Yahoo Weather feed API address
            var query = "select * from weather.forecast where " + queryType + " in (" + locationid + ") and u='" + options.unit + "'";
            var api = 'http://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent(query) + '&rnd=' + now.getFullYear() + now.getMonth() + now.getDay() + now.getHours() + '&format=json&callback=?';

            // Send request
            $.ajax({
                type: 'GET',
                url: api,
                dataType: 'json',
                success: function(data) {

                    if (data.query) {

                        if (data.query.results.channel.length > 0) {

                            // Multiple locations
                            var result = data.query.results.channel.length;
                            for (var i = 0; i < result; i++) {

                                // Create weather feed item
                                _process(e, data.query.results.channel[i], options);
                            }
                        } else {

                            // Single location only
                            _process(e, data.query.results.channel, options);
                        }

                        // Optional user callback function
                        if ($.isFunction(fn))
                            fn.call(this, $e);

                    } else {
                        if (options.showerror)
                            $e.html('<p>Weather information unavailable</p>');
                    }
                },
                error: function(data) {
                    if (options.showerror)
                        $e.html('<p>Weather request failed</p>');
                }
            });
            // Function to each feed item
            var _process = '';
        });
    };

})(jQuery);

