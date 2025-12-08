<?php

/**
 * @file
 * Create OAuth2 scopes for simple_oauth 6.0.x.
 *
 * This script creates dynamic OAuth2 scopes that can be used with
 * client_credentials and authorization_code grants.
 *
 * Usage:
 *   drush php:script scripts/create-scopes.php
 */

use Drupal\simple_oauth\Entity\Oauth2Scope;

$scopes_to_create = [
  [
    'name' => 'content:published',
    'description' => 'Read published content only (for production frontend)',
    'grant_types' => [
      'client_credentials' => ['status' => TRUE, 'description' => 'Server-to-server access'],
    ],
    'granularity_id' => 'role',
    'granularity_configuration' => ['role' => 'viewer'],
    'umbrella' => FALSE,
  ],
  [
    'name' => 'content:preview',
    'description' => 'Read all content including unpublished (for preview/staging)',
    'grant_types' => [
      'client_credentials' => ['status' => TRUE, 'description' => 'Server-to-server access'],
    ],
    'granularity_id' => 'role',
    'granularity_configuration' => ['role' => 'previewer'],
    'umbrella' => FALSE,
  ],
];

$created_scopes = [];
$skipped_scopes = [];

foreach ($scopes_to_create as $scope_data) {
  $scope_id = Oauth2Scope::scopeToMachineName($scope_data['name']);

  // Check if scope already exists
  $existing_scope = Oauth2Scope::load($scope_id);
  if ($existing_scope) {
    $skipped_scopes[] = $scope_data['name'];
    echo "⚠ Scope '{$scope_data['name']}' (ID: {$scope_id}) already exists. Skipping.\n";
    continue;
  }

  try {
    $scope = Oauth2Scope::create($scope_data);
    $scope->save();
    $created_scopes[] = $scope_data['name'];
    echo "✓ Created scope: {$scope_data['name']} (ID: {$scope_id})\n";
  } catch (\Exception $e) {
    echo "✗ Failed to create scope '{$scope_data['name']}': {$e->getMessage()}\n";
  }
}

echo "\n";
echo "=====================================\n";
echo "Scope Creation Summary\n";
echo "=====================================\n";
echo "Created: " . count($created_scopes) . " scope(s)\n";
if (!empty($created_scopes)) {
  foreach ($created_scopes as $name) {
    echo "  - {$name}\n";
  }
}

echo "\nSkipped: " . count($skipped_scopes) . " scope(s)\n";
if (!empty($skipped_scopes)) {
  foreach ($skipped_scopes as $name) {
    echo "  - {$name}\n";
  }
}
