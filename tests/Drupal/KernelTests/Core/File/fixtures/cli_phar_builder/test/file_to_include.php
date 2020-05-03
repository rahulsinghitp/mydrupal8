<?php

/**
 * @file
 * Tests phar protection.
 */

use TYPO3\PharStreamWrapper\Exception as PharStreamWrapperException;

/**
 * Writes a line.
 */
function write_line() {
  echo "Included a file inside the phar using 'phar://cli_phar/test/file_to_include.php'.\n";
}

/**
 * Includes phar files.
 */
function phar_shutdown() {
  if (file_exists(Phar::running() . '/index.php')) {
    echo "Shutdown functions work in phar files without a .phar extension.\n";
  }
  // Try an insecure phar without an extension.
  try {
    file_exists('phar://cli_phar.png');
  }
  catch (PharStreamWrapperException $e) {
    echo "Shutdown functions cannot access other phar files without .phar extension.\n";
  }
}
