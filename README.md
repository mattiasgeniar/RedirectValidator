# RedirectValidator
A PHP script that reads a CSV file and validates that the "from" column redirects to the "to" column. Uses PHP &amp; curl.

# Usage

```
$  php validate_redirects.php
[Y] http://news.ycombinator.com -> https://news.ycombinator.com/
[Y] http://www.nucleus.be/ -> https://www.nucleus.be/
[X] https://controlpanel.nucleus.be -> https://controlpanel.nucleus.be/en/ (redirected to https://controlpanel.nucleus.be/en/auth/login/)
```

Update ```example.csv``` with the redirects you want to validate.

In the example above the first 2 redirects work as intended, the second didn't redirect correctly and was marked as such.
