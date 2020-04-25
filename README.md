# Referral Tracker

This plugin tracks referral links from $_GET variables by setting a cookie, which can then be used in a shortcode to create outgoing links.

Example shortcode where |*referral*| will be replaced dynamically:  
`[referral_link link="https://example.com/|*referral*|" text="Click here to redeem" type="text" target="_blank"]`
