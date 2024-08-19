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
        "client_secret " => $previewerClientSecret,
        "label" => "Previewer",
        "user_id" => 2,
        "third_party" => true,
        "is_default" => false,
        "roles" => ["previewer"],
    ])
    ->save();
