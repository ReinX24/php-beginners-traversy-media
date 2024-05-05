<?php

// How to set cookies
// key, value, and lifetime
// setcookie("key", "value", time() + 60);

// How to update cookies
// setcookie("key", "value [updated]", time() + 3600);

// How to delete cookies
setcookie("key", "", time() - 1);
