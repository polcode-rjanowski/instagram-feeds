## Main files/classes

app/Controller/InstagramController

app/Lib/InstagramService - main class contains necessary functions to work with Instagram API

app/Console/Command/RetriveUserInstagramFeedsShell - class for getting users recent feeds from Instagram

    can be used as a cron job (command below)

    cd /*full_path_to_main_project_directory*/app && Console/cake RetriveUserInstagramFeeds


app/webroot/js,

app/webroot/css folders contains stylesheets and javascripts used in project