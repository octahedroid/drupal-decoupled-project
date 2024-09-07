<?php

/**
 * @file
 * Contains consumers.php.
 */

$menu_link_storage = \Drupal::entityTypeManager()->getStorage('menu_link_content');

// Define the custom menu link items.
$links = [
  [
    'menu_name' => 'main',
    'link_path' => '<front>',
    'link_title' => 'Home',
    'link_description' => 'Link to Home page.',
    'weight' => 0,
  ],
  [
    'menu_name' => 'main',
    'link_path' => 'blog',
    'link_title' => 'Blog',
    'link_description' => 'Link to the blog page.',
    'weight' => 1,
  ],
  [
    'menu_name' => 'main',
    'link_path' => 'contact',
    'link_title' => 'Contact',
    'link_description' => 'Link to the contact page.',
    'weight' => 2,
  ],
];

foreach ($links as $link) {
  $menu_link_storage->create([
    'menu_name' => $link['menu_name'],
    'link' => ['uri' => 'internal:/' . $link['link_path']],
    'title' => $link['link_title'],
    'description' => $link['link_description'],
    'weight' => $link['weight'],
  ])->save();
}
