Element: HTTP Exception
=======================

###### Element: HTTP Exception

## Misusing the Exception

- similarity between [HTTP/1.1](http://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol "Hypertext Transfer Protocol") and [PHP Exception](http://php.net/manual/en/language.exceptions.php "Exceptions"): code and messages
- methods return the value they requested – no more checking for `null`, `true`/`false` or `int` in case of more values to test
- Exception can bubble to the top of the called code (e.g when you need to show an error page)

HTTP_Exception requires only [HTTP status code](http://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol#Status_codes) to be thrown. You can still use any code and message.

**Enjoy!**

[@martin_adamko](http://twitter.com/martin_adamko)  
*Say hi on Twitter*
