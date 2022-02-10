# 32809757-Facebook-Link-Batch-Scraper-Tool
Project: [Facebook Link Batch Re-Scraper Tool](https://www.freelancer.com/projects/python/Facebook-Link-Batch-Scraper-Tool)

# How to use
1. Set FB access token in file usage.php: `$accessToken="your_fb_user_access_token"` || Set env`FACEBOOK_ACCESS_TOKEN="your_fb_user_access_token"` if using from cli and make sure to set the usage.php `$accessToken=''` else env will be ignored.
2. put the urls which you want to scrape in the `urls.txt` file
3. run the script `php usage.php` or `http://localhost/usage.php`