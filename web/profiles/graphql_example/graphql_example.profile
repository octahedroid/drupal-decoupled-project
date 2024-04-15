<?php

function graphql_example_install_tasks_alter(&$tasks, $install_state) {
  $tasks['install_configure_form']['display'] = FALSE;
  $tasks['install_configure_form']['run'] = INSTALL_TASK_SKIP;
}
