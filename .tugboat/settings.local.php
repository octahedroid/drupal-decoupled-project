<?php
// Use the TUGBOAT_REPO_ID to generate a hash salt for Tugboat sites.
$settings["hash_salt"] = hash("sha256", getenv("TUGBOAT_REPO_ID"));

global $config;
$tugboatHost =
    getenv("TUGBOAT_DEFAULT_SERVICE_URL_PROTOCOL") .
    "://" .
    getenv("TUGBOAT_DEFAULT_SERVICE_URL_HOST");
$config["decoupled_preview_iframe.settings"]["redirect_anonymous"] = false;
$config["decoupled_preview_iframe.settings"]["redirect_url"] = $tugboatHost;
$config["decoupled_preview_iframe.settings"]["preview_url"] = $tugboatHost;
