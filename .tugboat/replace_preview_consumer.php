<?php

$consumerStorage = \Drupal::entityTypeManager()->getStorage("consumer");

$previewerClientId = getenv("TUGBOAT_DEFAULT_SERVICE_ID");
$previewerClientSecret =
    getenv("TUGBOAT_PREVIEW_ID") . getenv("TUGBOAT_DEFAULT_SERVICE_TOKEN");

$previewers = $consumerStorage->loadByProperties([
    "label" => "Previewer",
]);
foreach ($previewers as $previewer) {
    $previewer->delete();
}

$consumerStorage
    ->create([
        "client_id" => $previewerClientId,
        "secret" => $previewerClientSecret,
        "label" => "Previewer",
        "user_id" => 2,
        "third_party" => true,
        "is_default" => false,
        "roles" => ["previewer"],
        "grant_types" => ["client_credentials"],
        "scopes" => [
            ["scope_id" => "content_preview"],
        ],
    ])
    ->save();
