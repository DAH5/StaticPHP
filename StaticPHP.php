<?php

class StaticPHP
{
	private $source_dir_path = "src";
	private $output_dir_path = "public";
	private $items_to_ignore = array( "_includes" );
	private $friendly_urls = false;
	private $metaDataDelimiter = "---";
	private $minify_html = false;
	private $minify_css = false;
	private $minify_js = false;
	private $minify_html_tags_to_preserve = array();
	private $bulk_redirects_filename = "_bulk_redirects";
	private $redirection_template_filename = "_redirection_template.html";
	private $minify_css_inplace = true;
	private $items_to_passthrough = array();
	private $test_mode = false;
	private $test_mode_input_dir_path = "tests/input";
	private $test_mode_expected_dir_path = "tests/expected";
	private $test_mode_output_dir_path = "tests/output";
	private $test_mode_output_results_file = true;
	private $test_mode_results_file_path = "tests/output/results.html";
	private $generate_standard_redirects_file = false;
	private $generate_htaccess_redirections = false;

	private $tests_successful = array();
	private $tests_unknown = array();
	private $tests_failed = array();

	public function __construct()
	{
		$args = func_get_args();

		// Array Method
		if( count( $args ) >= 1 && is_array( $args[ 0 ] ) )
		{
			$configurable_options = $args[ 0 ];

			if( isset( $configurable_options[ 'source_dir_path' ] ) && is_string( $configurable_options[ 'source_dir_path' ] ) && trim( $configurable_options[ 'source_dir_path' ] ) != "" )
				$this->source_dir_path = trim( $configurable_options[ 'source_dir_path' ] );
			if( isset( $configurable_options[ 'output_dir_path' ] ) && is_string( $configurable_options[ 'output_dir_path' ] ) && trim( $configurable_options[ 'output_dir_path' ] ) != "" )
				$this->output_dir_path = trim( $configurable_options[ 'output_dir_path' ] );
			if( isset( $configurable_options[ 'items_to_ignore' ] ) && is_array( $configurable_options[ 'items_to_ignore' ] ) && count( $configurable_options[ 'items_to_ignore' ] ) > 0 )
				$this->items_to_ignore = $configurable_options[ 'items_to_ignore' ];
			if( isset( $configurable_options[ 'items_to_ignore' ] ) && is_string( $configurable_options[ 'items_to_ignore' ] ) && trim( $configurable_options[ 'items_to_ignore' ] ) != "" )
				$this->items_to_ignore = array( trim( $configurable_options[ 'items_to_ignore' ] ) );
			if( isset( $configurable_options[ 'friendly_urls' ] ) && is_bool( $configurable_options[ 'friendly_urls' ] ) )
				$this->friendly_urls = $configurable_options[ 'friendly_urls' ];
			if( isset( $configurable_options[ 'friendly_urls' ] ) && is_string( $configurable_options[ 'friendly_urls' ] ) && trim( $configurable_options[ 'friendly_urls' ] ) == "true" )
				$this->friendly_urls = true;
			if( isset( $configurable_options[ 'metadata_delimiter' ] ) && is_string( $configurable_options[ 'metadata_delimiter' ] ) && trim( $configurable_options[ 'metadata_delimiter' ] ) != "" )
				$this->metaDataDelimiter = $configurable_options[ 'metadata_delimiter' ];
			if( isset( $configurable_options[ 'minify_html' ] ) && is_bool( $configurable_options[ 'minify_html' ] ) )
				$this->minify_html = $configurable_options[ 'minify_html' ];
			if( isset( $configurable_options[ 'minify_html' ] ) && is_string( $configurable_options[ 'minify_html' ] ) && trim( $configurable_options[ 'minify_html' ] ) == "true" )
				$this->minify_html = true;
			if( isset( $configurable_options[ 'minify_css' ] ) && is_bool( $configurable_options[ 'minify_css' ] ) )
				$this->minify_css = $configurable_options[ 'minify_css' ];
			if( isset( $configurable_options[ 'minify_css' ] ) && is_string( $configurable_options[ 'minify_css' ] ) && trim( $configurable_options[ 'minify_css' ] ) == "true" )
				$this->minify_css = true;
			if( isset( $configurable_options[ 'minify_js' ] ) && is_bool( $configurable_options[ 'minify_js' ] ) )
				$this->minify_js = $configurable_options[ 'minify_js' ];
			if( isset( $configurable_options[ 'minify_js' ] ) && is_string( $configurable_options[ 'minify_js' ] ) && trim( $configurable_options[ 'minify_js' ] ) == "true" )
				$this->minify_js = true;
			if( isset( $configurable_options[ 'minify_html_tags_to_preserve' ] ) && is_array( $configurable_options[ 'minify_html_tags_to_preserve' ] ) && count( $configurable_options[ 'minify_html_tags_to_preserve' ] ) > 0 )
				$this->minify_html_tags_to_preserve = $configurable_options[ 'minify_html_tags_to_preserve' ];
			if( isset( $configurable_options[ 'minify_html_tags_to_preserve' ] ) && is_string( $configurable_options[ 'minify_html_tags_to_preserve' ] ) && trim( $configurable_options[ 'minify_html_tags_to_preserve' ] ) != "" )
				$this->minify_html_tags_to_preserve = array( trim( $configurable_options[ 'minify_html_tags_to_preserve' ] ) );
			if( isset( $configurable_options[ 'bulk_redirects_filename' ] ) && is_string( $configurable_options[ 'bulk_redirects_filename' ] ) && trim( $configurable_options[ 'bulk_redirects_filename' ] ) != "" )
				$this->bulk_redirects_filename = trim( $configurable_options[ 'bulk_redirects_filename' ] );
			if( isset( $configurable_options[ 'redirection_template_filename' ] ) && is_string( $configurable_options[ 'redirection_template_filename' ] ) && trim( $configurable_options[ 'redirection_template_filename' ] ) != "" )
				$this->redirection_template_filename = trim( $configurable_options[ 'redirection_template_filename' ] );
			if( isset( $configurable_options[ 'minify_css_inplace' ] ) && is_bool( $configurable_options[ 'minify_css_inplace' ] ) )
				$this->minify_css_inplace = $configurable_options[ 'minify_css_inplace' ];
			if( isset( $configurable_options[ 'items_to_passthrough' ] ) && is_array( $configurable_options[ 'items_to_passthrough' ] ) && count( $configurable_options[ 'items_to_passthrough' ] ) > 0 )
				$this->items_to_passthrough = $configurable_options[ 'items_to_passthrough' ];
			if( isset( $configurable_options[ 'items_to_passthrough' ] ) && is_string( $configurable_options[ 'items_to_passthrough' ] ) && trim( $configurable_options[ 'items_to_passthrough' ] ) != "" )
				$this->items_to_passthrough = array( $configurable_options[ 'items_to_passthrough' ] );
			if( isset( $configurable_options[ 'test_mode' ] ) && is_bool( $configurable_options[ 'test_mode' ] ) )
				$this->test_mode = $configurable_options[ 'test_mode' ];
			if( isset( $configurable_options[ 'test_mode_input_dir_path' ] ) && is_string( $configurable_options[ 'test_mode_input_dir_path' ] ) && trim( $configurable_options[ 'test_mode_input_dir_path' ] ) != "" )
				$this->test_mode_input_dir_path = $configurable_options[ 'test_mode_input_dir_path' ];
			if( isset( $configurable_options[ 'test_mode_expected_dir_path' ] ) && is_string( $configurable_options[ 'test_mode_expected_dir_path' ] ) && trim( $configurable_options[ 'test_mode_expected_dir_path' ] ) != "" )
				$this->test_mode_expected_dir_path = $configurable_options[ 'test_mode_expected_dir_path' ];
			if( isset( $configurable_options[ 'test_mode_output_dir_path' ] ) && is_string( $configurable_options[ 'test_mode_output_dir_path' ] ) && trim( $configurable_options[ 'test_mode_output_dir_path' ] ) != "" )
				$this->test_mode_output_dir_path = $configurable_options[ 'test_mode_output_dir_path' ];
			if( isset( $configurable_options[ 'test_mode_output_results_file' ] ) && is_bool( $configurable_options[ 'test_mode_output_results_file' ] ) )
				$this->test_mode_output_results_file = $configurable_options[ 'test_mode_output_results_file' ];
			if( isset( $configurable_options[ 'test_mode_results_file_path' ] ) && is_string( $configurable_options[ 'test_mode_results_file_path' ] ) && trim( $configurable_options[ 'test_mode_results_file_path' ] ) != "" )
				$this->test_mode_results_file_path = $configurable_options[ 'test_mode_results_file_path' ];
			if( isset( $configurable_options[ 'generate_standard_redirects_file' ] ) && is_bool( $configurable_options[ 'generate_standard_redirects_file' ] ) )
				$this->generate_standard_redirects_file = $configurable_options[ 'generate_standard_redirects_file' ];
			if( isset( $configurable_options[ 'generate_htaccess_redirections' ] ) && is_bool( $configurable_options[ 'generate_htaccess_redirections' ] ) )
				$this->generate_htaccess_redirections = $configurable_options[ 'generate_htaccess_redirections' ];
		}
		// End Array Method

		// Arguments Method
		if( count( $args ) >= 1 && is_string( $args[ 0 ] ) && trim( $args[ 0 ] ) != "" )
			$this->source_dir_path = trim( $args[ 0 ] );
		if( count( $args ) >= 2 && is_string( $args[ 1 ] ) && trim( $args[ 1 ] ) != "" )
			$this->output_dir_path = trim( $args[ 1 ] );
		if( count( $args ) >= 3 && is_array( $args[ 2 ] ) && count( $args[ 2 ] ) > 0 )
			$this->items_to_ignore = trim( $args[ 2 ] );
		if( count( $args ) >= 3 && is_string( $args[ 2 ] ) && trim( $args[ 2 ] ) != "" )
			$this->items_to_ignore = array( trim( $args[ 2 ] ) );
		if( count( $args ) >= 4 && is_bool( $args[ 3 ] ) )
			$this->friendly_urls = $args[ 3 ];
		if( count( $args ) >= 4 && is_string( $args[ 3 ] ) && trim( $args[ 3 ] ) == "true" )
			$this->friendly_urls = true;
		if( count( $args ) >= 5 && is_string( $args[ 4 ] ) && trim( $args[ 4 ] ) != "" )
			$this->metaDataDelimiter = trim( $args[ 4 ] );
		if( count( $args ) >= 6 && is_bool( $args[ 5 ] ) )
			$this->minify_html = $args[ 5 ];
		if( count( $args ) >= 6 && is_string( $args[ 5 ] ) && trim( $args[ 5 ] ) == "true" )
			$this->minify_html = true;
		if( count( $args ) >= 7 && is_bool( $args[ 6 ] ) )
			$this->minify_css = $args[ 6 ];
		if( count( $args ) >= 7 && is_string( $args[ 6 ] ) && trim( $args[ 6 ] ) == "true" )
			$this->minify_css = true;
		if( count( $args ) >= 8 && is_bool( $args[ 7 ] ) )
			$this->minify_js = $args[ 7 ];
		if( count( $args ) >= 8 && is_string( $args[ 7 ] ) && trim( $args[ 7 ] ) == "true" )
			$this->minify_js = true;
		if( count( $args ) >= 9 && is_array( $args[ 8 ] ) && count( $args[ 8 ] ) > 0 )
			$this->minify_html_tags_to_preserve = trim( $args[ 8 ] );
		if( count( $args ) >= 9 && is_string( $args[ 8 ] ) && trim( $args[ 8 ] ) != "" )
			$this->minify_html_tags_to_preserve = array( trim( $args[ 8 ] ) );
		if( count( $args ) >= 10 && is_string( $args[ 9 ] ) && trim( $args[ 9 ] ) != "" )
			$this->bulk_redirects_filename = trim( $args[ 9 ] );
		if( count( $args ) >= 11 && is_string( $args[ 10 ] ) && trim( $args[ 10 ] ) != "" )
			$this->redirection_template_filename = trim( $args[ 10 ] );
		if( count( $args ) >= 12 && is_bool( $args[ 11 ] ) )
			$this->minify_css_inplace = $args[ 11 ];
		if( count( $args ) >= 13 && is_array( $args[ 12 ] ) )
			$this->items_to_passthrough = $args[ 12 ];
		if( count( $args ) >= 14 && is_bool( $args[ 13 ] ) )
			$this->generate_standard_redirects_file = $args[ 13 ];
		if( count( $args ) >= 15 && is_bool( $args[ 14 ] ) )
			$this->generate_htaccess_redirections = $args[ 14 ];
		// End Arguments Method

		// Ensure Special Files are Ignored
		if( ! in_array( $this->redirection_template_filename, $this->items_to_ignore ) )
			$this->items_to_ignore[] = $this->redirection_template_filename;

		$this->source_dir_path = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $this->source_dir_path );
		$this->output_dir_path = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $this->output_dir_path );

		if( $this->test_mode )
		{
			$this->test_mode_input_dir_path = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $this->test_mode_input_dir_path );
			$this->test_mode_expected_dir_path = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $this->test_mode_expected_dir_path );
			$this->test_mode_output_dir_path = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $this->test_mode_output_dir_path );

			$this->emptyDirectory( $this->test_mode_output_dir_path );
			$this->processDirectory( $this->test_mode_input_dir_path, $this->test_mode_output_dir_path );

			echo "Test results: " . count( $this->tests_successful ) . " successful, " . count( $this->tests_failed ) . " failed, " . count( $this->tests_unknown ) . " unknown." . PHP_EOL . PHP_EOL;

			if( isset( $this->test_mode_results_file_path ) && $this->test_mode_results_file_path && $this->test_mode_output_results_file )
			{
				$successful_results = implode( "<br>" . PHP_EOL, $this->tests_successful );
				$failed_results = implode( "<br>" . PHP_EOL, $this->tests_failed );
				$unknown_results = implode( "<br>" . PHP_EOL, $this->tests_unknown );

				$successful_results_count = count( $this->tests_successful );
				$failed_results_count = count( $this->tests_failed );
				$unknow_results_count = count( $this->tests_unknown );

				$resultsHTML = <<<HTML
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>StaticPHP Test Results</title>

		<style type="text/css">
			*, *::before, *::after { box-sizing: border-box; }
			html, body { font-family: system-ui, sans-serif; font-size: 1rem; background-color: #eee; color: #333; }
			.container { max-width: 1200px; margin-left: auto; margin-right: auto; padding: 1rem; }
			@media ( prefers-color-scheme: dark )
			{
				html, body { background-color: #111; color: #ddd; }
			}
		</style>
	</head>

	<body>
		<div class="container">
			<h1>StaticPHP Test Results</h1>

			<hr>

			<h2 style="color: green;">$successful_results_count Successful</h2>
			
			$successful_results

			<h2 style="color: red;">$failed_results_count Failed</h2>
			
			$failed_results

			<h2 style="color: gray;">$unknow_results_count Unknown</h2>
			
			$unknown_results
		</div>
	</body>
</html>

HTML;

				$this->outputFile( $this->test_mode_results_file_path, $resultsHTML );
			}

			exit;
		}

		$this->emptyDirectory( $this->output_dir_path );
		$this->processDirectory( $this->source_dir_path, $this->output_dir_path );
	}
	
	private function emptyDirectory( String $path_to_directory )
	{
		if( ! is_dir( $path_to_directory ) )
			return;
		
		echo "Emptying Directory: " . $path_to_directory . PHP_EOL;
		
		$directory_items = scandir( $path_to_directory );
		
		if( count( $directory_items ) == 2 )
			echo "Directory Already Empty." . PHP_EOL;
		
		foreach( $directory_items as $directory_item )
		{
			if( $directory_item == "." || $directory_item == ".." )
				continue;
			
			$path_to_directory_item = $path_to_directory . DIRECTORY_SEPARATOR . $directory_item;
			
			if( is_dir( $path_to_directory_item ) )
			{
				$this->emptyDirectory( $path_to_directory_item );
				echo "Removing Directory: " . $path_to_directory_item . PHP_EOL;
				rmdir( $path_to_directory_item );
				continue;
			}
			
			if( is_file( $path_to_directory_item ) )
			{
				echo "Deleting File: " . $path_to_directory_item . PHP_EOL;
				unlink( $path_to_directory_item );
				continue;
			}
		}
		
		if( count( $directory_items ) > 2 )
			echo "Done." . PHP_EOL;
	}
	
	private function processDirectory( String $path_to_input_directory, String $path_to_output_directory )
	{
		if( ! is_dir( $path_to_input_directory ) )
			die( "Directory does not exist: " . $path_to_input_directory );
        	
		echo "Processing Directory: " . $path_to_input_directory . PHP_EOL;
		
		$directory_items = scandir( $path_to_input_directory );
		
		if( ! is_dir( $path_to_output_directory ) && count( $directory_items ) > 2 )
		{
			echo "Created New Directory: " . $path_to_output_directory . PHP_EOL;
			mkdir( $path_to_output_directory );
		}
		
		if( count( $directory_items ) == 2 )
		{
			echo "Input directory is empty. Nothing to process." . PHP_EOL;
		}
		
		foreach( $directory_items as $directory_item )
		{
			if( $directory_item == "." || $directory_item == ".." )
				continue;
			
			$path_to_input_directory_item = $path_to_input_directory . DIRECTORY_SEPARATOR . $directory_item;
			$path_to_output_directory_item = $path_to_output_directory . DIRECTORY_SEPARATOR . $directory_item;
			
			if( is_array( $this->items_to_ignore ) )
			{
				foreach( $this->items_to_ignore as $item_to_ignore )
				{
					if( $item_to_ignore != "" && strpos( $directory_item, $item_to_ignore ) !== false )
					{
						echo "Ignoring Directory Item: " . $path_to_input_directory_item . PHP_EOL;
						continue( 2 );
					}
				}
			}

			if( is_array( $this->items_to_passthrough ) )
			{
				foreach( $this->items_to_passthrough as $item_to_passthrough )
				{
					if( $item_to_passthrough != "" && strpos( $path_to_input_directory_item, $item_to_passthrough ) !== false && is_file( $path_to_input_directory_item ) )
					{
						echo "Passing Through File: " . $path_to_input_directory_item . PHP_EOL;
						copy( $path_to_input_directory_item, $path_to_output_directory_item );
						continue( 2 );
					}
				}
			}

			if( is_dir( $path_to_input_directory_item ) )
			{
				$this->processDirectory( $path_to_input_directory_item, $path_to_output_directory_item );
			}
			
			if( is_file( $path_to_input_directory_item ) && substr( $directory_item, -4 ) == ".php" )
			{
				$path_to_output_directory_item = substr( $path_to_output_directory_item, 0, -4 ) . ".html";
				
				$this->processPHP( $path_to_input_directory_item, $path_to_output_directory_item );
				continue;
			}

			if( is_file( $path_to_input_directory_item ) && substr( $directory_item, -5 ) == ".html" )
			{
				$this->processHTML( $path_to_input_directory_item, $path_to_output_directory_item );
				continue;
			}

			if( is_file( $path_to_input_directory_item ) && substr( $directory_item, -3 ) == ".md" )
			{
				$path_to_output_directory_item = substr( $path_to_output_directory_item, 0, -3 ) . ".html";

				$this->processMarkdown( $path_to_input_directory_item, $path_to_output_directory_item );
				continue;
			}

			if( is_file( $path_to_input_directory_item ) && $directory_item == $this->bulk_redirects_filename )
			{
				$redirect_list_file_contents = file_get_contents( $path_to_input_directory_item );
				$redirect_list_file_contents = $this->convertEndOfLines( $redirect_list_file_contents );

				$this->processBulkRedirects( $redirect_list_file_contents, $path_to_output_directory );
				continue;
			}
			
			if( is_file( $path_to_input_directory_item ) )
			{
				if( $this->minify_css === true && substr( $path_to_input_directory_item, -4 ) == ".css" )
				{
					echo "Minifying CSS File: " . $path_to_input_directory_item . PHP_EOL;

					$css = file_get_contents( $path_to_input_directory_item );
					
					$css_minified = $this->minifyCSS( $css );

					if( $this->minify_css_inplace )
					{
						$this->outputFile( $path_to_output_directory_item, $css_minified );
						continue;
					}
					else
					{
						$this->outputFile( str_replace( ".css", ".min.css", $path_to_output_directory_item ), $css_minified );
						$this->outputFile( $path_to_output_directory_item, $css );
						continue;
					}
				}

				if( $this->minify_js === true && substr( $path_to_input_directory_item, -3 ) == ".js" )
				{
					echo "Minifying JS File: " . $path_to_input_directory_item . PHP_EOL;

					$js = file_get_contents( $path_to_input_directory_item );

					$js = $this->minifyJS( $js );

					$this->outputFile( $path_to_output_directory_item, $js );

					continue;
				}

				echo "Copying File: " . $path_to_input_directory_item . " to " . $path_to_output_directory_item . PHP_EOL;
				copy( $path_to_input_directory_item, $path_to_output_directory_item );
			}
		}
		
		if( count( $directory_items ) > 2 )
		{
			echo "Done.\n";
		}
	}
	
	private function processMetaData( String $delimiter, String $input_contents, array &$metadata, String &$output_contents )
	{
		if( ! isset( $metadata['staticphp_path'] ) )
			$metadata['staticphp_path'] = __DIR__;

		$input_contents = $this->convertEndOfLines( $input_contents );
		
		$input_lines = explode( PHP_EOL, $input_contents );

		$input_line_count = count( $input_lines );
		
		if( count( $input_lines ) > 1 && trim( $input_lines[ 0 ] ) == $delimiter )
		{
			echo "Processing MetaData..." . PHP_EOL . PHP_EOL;
			
			unset( $input_lines[ 0 ] );
			
			for( $line_number = 1; $line_number <= $input_line_count; $line_number++ )
			{
				$input_line = trim( $input_lines[ $line_number ] );
				
				unset( $input_lines[ $line_number ] );
				
				if( $input_line == $delimiter )
					break;
				
				if( ! strpos( $input_line, ":" ) )
					continue;
				
				$data = explode( ":", $input_line, 2 );
				
				$metadata_key = trim( $data[ 0 ] );
				$metadata_value = trim( $data[ 1 ] );
				
				echo "Setting MetaData Key: " . $metadata_key . PHP_EOL;
				echo "with matching value: " . $metadata_value . PHP_EOL . PHP_EOL;
				$metadata[ $metadata_key ] = $metadata_value;
			}
			
			$output_contents = join( PHP_EOL, $input_lines );
			
			echo "End of MetaData." . PHP_EOL . PHP_EOL;
		}
	}
	
	private function processMetaDataPlaceHolders( String $delimiter, String $input_contents, array $metadata, String &$output_contents, String $prefix = 'metadata' )
	{
		echo "Processing MetaData PlaceHolders..." . PHP_EOL;
		$pattern = '/' . $delimiter . '\s*' . $prefix . '\.(\S+)\s*' . $delimiter . '/';
		
		$output_contents = preg_replace_callback
		(
			$pattern,
			function( $matches ) use ( $metadata )
			{
				$key = $matches[ 1 ];
				
				if( array_key_exists( $key, $metadata ) )
				{
					$value = $metadata[ $key ];
					echo "Replacing " . $key . " with " . $value . PHP_EOL;
					return $value;
				}
				else
				{
					return $matches[ 0 ];
				}
			},
			$input_contents
		);
		echo "Done.\n\n";
	}
	
	private function processLayoutMetaData( array &$metadata, string $metaDataDelimiter, string &$layout_contents )
	{
		if( ! isset( $metadata[ 'layout' ] ) )
			return;
		if( ! is_string( $metadata[ 'layout' ] ) )
			return;
		if( strlen( $metadata[ 'layout' ] ) <= 0 )
			return;

		$base_layout_path = __DIR__ . DIRECTORY_SEPARATOR . $metadata[ 'layout' ];

		if( ! is_file( $base_layout_path ) )
			return;

		echo "Processing layout file: " . $base_layout_path . PHP_EOL;
		
		$layout_contents = file_get_contents( $base_layout_path );

		$layout_metadata = array();

		$this->processMetaData( $metaDataDelimiter, $layout_contents, $layout_metadata, $layout_contents );
		
		$metadata = array_merge( $layout_metadata, $metadata );
	}
	
	private function processContentPlaceHolder( array $metadata, string &$file_contents, string $layout_contents )
	{
		// Check for no layout content and return early.
		if( ! $layout_contents )
			return;

		// Set a safe default content placeholder if a custom one has not been set.
		if( ! isset( $metadata[ 'content_placeholder' ] ) || ! trim( $metadata[ 'content_placeholder' ] ) )
		{
			$metadata[ 'content_placeholder' ] = "{{ content }}";
		}

		// Update current page content with the layout content, replacing the placeholder with the content of current page, and log the action.
		echo "Replacing content placeholder with page content..." . PHP_EOL;
		$file_contents = str_replace( trim( $metadata['content_placeholder'] ), $file_contents, $layout_contents );
	}
	
	private function processTemporaryFile( string $path_to_file, string &$file_contents, array $metadata )
	{
		$temp_file_path = tempnam( dirname( $path_to_file ), "staticphp_" );
		echo "Creating temporary file (" . $temp_file_path . ")..." . PHP_EOL;
		file_put_contents( $temp_file_path, $file_contents );
		
		echo "Including temporary file..." . PHP_EOL;
        
		ob_start();
		
		include $temp_file_path;
		$file_contents = ob_get_contents();
		
		ob_end_clean();
		
		echo "Removing temporary file..." . PHP_EOL;
		unlink( $temp_file_path );
	}
	
	private function processOutputPath( string &$path_to_output_file, array $metadata, bool $friendly_urls, string $custom_output_path = null )
	{
		// Check if output file is index.html and skip further processing.
		if( basename( $path_to_output_file ) == "index.html" )
			return;
		
		// Is a custom output path defined?
		if( isset( $metadata['custom_output_path'] ) || $custom_output_path )
		{
			if( isset( $metadata['custom_output_path'] ) )
			{
				$path_to_output_file = $metadata['custom_output_path'];
				return;
			}
			
			$path_to_output_file = $custom_output_path;
			return;
		}

		// No custom output path defined, check for friendly URLs in metadata and give it priority.
		if( isset( $metadata['friendly_urls'] ) )
		{
			if( $metadata['friendly_urls'] == "true" )
				$friendly_urls = true;
			if( $metadata['friendly_urls'] == "false" )
				$friendly_urls = false;
		}
		
		// Check if friendly URLs are enabled.
		if( $friendly_urls )
		{
			// Check if a directory matching the output filename minus the extension exists.
			if( ! is_dir( substr( $path_to_output_file, 0, -5 ) ) )
			{
				// Create a directory matching the output filename minus the extension.
				mkdir( substr( $path_to_output_file, 0, -5 ) );
			}
			
			// Set path to output file to that of a directory with the same name minus extension with an index.html file inside it.
			$path_to_output_file = substr( $path_to_output_file, 0, -5 ) . DIRECTORY_SEPARATOR . "index.html";
		}
	}

	private function outputFile( string $path_to_file, string $file_contents )
	{
		echo "Outputting File: " . $path_to_file . PHP_EOL;

		$dir = dirname( $path_to_file );

		// 1) Ensure the output directory exists
		if( $dir !== '' && ! is_dir( $dir ) )
		{
			if( ! @mkdir( $dir, 0775, true ) )
			{
				echo "✗ Could not create directory: '" . $dir . "'. Check permissions/ownership and available disk space." . PHP_EOL;
				return;
			}

			// Best effort permission set (ignore failure)
			@chmod( $dir, 0775 );
		}

		// 2) Open the file for writing (binary mode avoids newline surprises on Windows)
		$fp = @fopen( $path_to_file, 'wb' );
		
		if( $fp === false )
		{
			echo "✗ Could not open file for writing: '" . $path_to_file . "'. Verify path, permissions, and that the parent directory is writable." . PHP_EOL;
			return;
		}

		// 3) Write the contents robustly
		$total = strlen( $file_contents );
		$written = 0;

		// Handle large strings by writing in chunks
		while( $written < $total )
		{
			$chunk = substr( $file_contents, $written, 1_048_576 ); // 1 MB chunks
			$n = @fwrite( $fp, $chunk );

			if( $n === false )
			{
				echo "✗ Write failed part-way through: '" . $path_to_file . "'. Output may be incomplete." . PHP_EOL;
				@fclose( $fp );
				return;
			}

			$written += $n;
		}

		@fclose( $fp );

		// 4) Set file permissions (0644 is typical for static files)
		@chmod( $path_to_file, 0644 );

		echo "✓ Wrote " . $written . " bytes → " . $path_to_file . "." . PHP_EOL;
	}
	
	private function processPHP( $path_to_input_file, $path_to_output_file )
	{
		if( ! isset( $staticphp_path ) )
			$staticphp_path = __DIR__;

		if( ! is_file( $path_to_input_file ) )
			return;
		
		echo "Processing PHP File: " . $path_to_input_file . PHP_EOL;
		
		ob_start();
		
		include $path_to_input_file;
		$input_file_contents = ob_get_contents();
		
		ob_end_clean();

		// Convert end of lines
		$input_file_contents = $this->convertEndOfLines( $input_file_contents );
		
		$metadata = array();
		
		$this->processMetaData( $this->metaDataDelimiter, $input_file_contents, $metadata, $input_file_contents );
		
		$layout_contents = "";
		$this->processLayoutMetaData( $metadata, $this->metaDataDelimiter, $layout_contents );

		if( isset( $metadata['layout'] ) && $metadata['layout'] && substr( $metadata['layout'], -4 ) == ".php" )
			$this->processTemporaryFile( $metadata['layout'], $layout_contents, $metadata );
		
		$this->processContentPlaceHolder( $metadata, $input_file_contents, $layout_contents );
		
		$this->processMetaDataPlaceHolders( $this->metaDataDelimiter, $input_file_contents, $metadata, $input_file_contents );

		$input_file_contents = $this->processFunctionalBlocks( $input_file_contents, $metadata );

		if( ! isset( $friendly_urls ) )
			$friendly_urls = $this->friendly_urls;
		
		if( isset( $custom_output_path ) )
			$this->processOutputPath( $path_to_output_file, $metadata, $friendly_urls, $custom_output_path );
		else
			$this->processOutputPath( $path_to_output_file, $metadata, $friendly_urls );

		if( isset( $metadata[ 'remote_content_url' ] ) && isset( $metadata[ 'remote_content_placeholder' ] ) )
		{
			$remote_content_url = $metadata[ 'remote_content_url' ];
			$remote_content_placeholder = $metadata[ 'remote_content_placeholder' ];
			$remote_content_from_url = $this->getRemoteContentFromURL( $remote_content_url );
			$remote_content_from_url = $this->convertEndOfLines( $remote_content_from_url );

			if( substr( $remote_content_url, -3 ) == ".md" )
			{
				$remote_markdown_content = $this->convertMarkdownToHTML( $remote_content_from_url, $metadata, $friendly_urls, $path_to_output_file );
				$input_file_contents = str_replace( $remote_content_placeholder, $remote_markdown_content, $input_file_contents );
			}
		}
		
		if( isset( $metadata[ 'redirect' ] ) )
		{
			// File Path, Old Path, New Destination
			$this->processRedirection( $path_to_output_file, str_replace( $this->output_dir_path, '', $path_to_output_file ), $metadata[ 'redirect' ] );
			return;
		}
		
		if( $this->minify_html === true )
			$input_file_contents = $this->minifyHTML( $input_file_contents );

		if( $this->test_mode )
		{
			$this->prepareForTest( $input_file_contents, $path_to_output_file );
			return;
		}
		
		$this->outputFile( $path_to_output_file, $input_file_contents );
	}

	private function processHTML( $path_to_input_file, $path_to_output_file )
	{
		if( ! is_file( $path_to_input_file ) )
			return;

		echo "Processing HTML File: " . $path_to_input_file . PHP_EOL;

		$input_file_contents = file_get_contents( $path_to_input_file );

		// Convert end of lines
		$input_file_contents = $this->convertEndOfLines( $input_file_contents );

		$metadata = array();

		$this->processMetaData( $this->metaDataDelimiter, $input_file_contents, $metadata, $input_file_contents );

		$layout_contents = "";
		$this->processLayoutMetaData( $metadata, $this->metaDataDelimiter, $layout_contents );

		if( isset( $metadata['layout'] ) && $metadata['layout'] && substr( $metadata['layout'], -4 ) == ".php" )
			$this->processTemporaryFile( $metadata['layout'], $layout_contents, $metadata );

		$this->processContentPlaceHolder( $metadata, $input_file_contents, $layout_contents );

		$this->processMetaDataPlaceHolders( $this->metaDataDelimiter, $input_file_contents, $metadata, $input_file_contents );

		$input_file_contents = $this->processFunctionalBlocks( $input_file_contents, $metadata );

		if( ! isset( $friendly_urls ) )
			$friendly_urls = $this->friendly_urls;

		if( isset( $custom_output_path ) )
			$this->processOutputPath( $path_to_output_file, $metadata, $friendly_urls, $custom_output_path );
		else
			$this->processOutputPath( $path_to_output_file, $metadata, $friendly_urls );
		
		if( isset( $metadata[ 'remote_content_url' ] ) && isset( $metadata[ 'remote_content_placeholder' ] ) )
		{
			$remote_content_url = $metadata[ 'remote_content_url' ];
			$remote_content_placeholder = $metadata[ 'remote_content_placeholder' ];
			$remote_content_from_url = $this->getRemoteContentFromURL( $remote_content_url );
			$remote_content_from_url = $this->convertEndOfLines( $remote_content_from_url );

			if( substr( $remote_content_url, -3 ) == ".md" )
			{
				$remote_markdown_content = $this->convertMarkdownToHTML( $remote_content_from_url, $metadata, $friendly_urls, $path_to_output_file );
				$input_file_contents = str_replace( $remote_content_placeholder, $remote_markdown_content, $input_file_contents );
			}
		}
		
		if( isset( $metadata[ 'redirect' ] ) )
		{
			// File Path, Old Path, New Destination
			$this->processRedirection( $path_to_output_file, str_replace( $this->output_dir_path, '', $path_to_output_file ), $metadata[ 'redirect' ] );
			return;
		}
		
		if( $this->minify_html === true )
			$input_file_contents = $this->minifyHTML( $input_file_contents );

		if( $this->test_mode )
		{
			$this->prepareForTest( $input_file_contents, $path_to_output_file );
			return;
		}
		
		$this->outputFile( $path_to_output_file, $input_file_contents );
	}

	private function processMarkdown( $path_to_input_file, $path_to_output_file )
	{
		if( ! is_file( $path_to_input_file ) )
			return;

		echo "Processing Markdown File: " . $path_to_input_file . PHP_EOL;

		$input_file_contents = file_get_contents( $path_to_input_file );

		// Convert end of lines
		$input_file_contents = $this->convertEndOfLines( $input_file_contents );

		$metadata = array();

		$this->processMetaData( $this->metaDataDelimiter, $input_file_contents, $metadata, $input_file_contents );

		if( ! isset( $friendly_urls ) )
			$friendly_urls = $this->friendly_urls;

		$input_file_contents = $this->convertMarkdownToHTML( $input_file_contents, $metadata, $friendly_urls );

		$layout_contents = "";
		$this->processLayoutMetaData( $metadata, $this->metaDataDelimiter, $layout_contents );

		if( isset( $metadata['layout'] ) && $metadata['layout'] && substr( $metadata['layout'], -4 ) == ".php" )
			$this->processTemporaryFile( $metadata['layout'], $layout_contents, $metadata );

		$this->processContentPlaceHolder( $metadata, $input_file_contents, $layout_contents );

		$this->processMetaDataPlaceHolders( $this->metaDataDelimiter, $input_file_contents, $metadata, $input_file_contents );

		$this->processOutputPath( $path_to_output_file, $metadata, $friendly_urls );
		
		if( isset( $metadata[ 'remote_content_url' ] ) && isset( $metadata[ 'remote_content_placeholder' ] ) )
		{
			$remote_content_url = $metadata[ 'remote_content_url' ];
			$remote_content_placeholder = $metadata[ 'remote_content_placeholder' ];
			$remote_content_from_url = $this->getRemoteContentFromURL( $remote_content_url );
			$remote_content_from_url = $this->convertEndOfLines( $remote_content_from_url );

			if( substr( $remote_content_url, -3 ) == ".md" )
			{
				$remote_markdown_content = $this->convertMarkdownToHTML( $remote_content_from_url, $metadata, $friendly_urls );
				$input_file_contents = str_replace( $remote_content_placeholder, $remote_markdown_content, $input_file_contents );
			}
		}

		if( isset( $metadata[ 'redirect' ] ) )
		{
			// File Path, Old Path, New Destination
			$this->processRedirection( $path_to_output_file, str_replace( $this->output_dir_path, '', $path_to_output_file ), $metadata[ 'redirect' ] );
			return;
		}
		
		if( $this->minify_html === true )
			$input_file_contents = $this->minifyHTML( $input_file_contents );
		
		if( $this->test_mode )
		{
			$this->prepareForTest( $input_file_contents, $path_to_output_file );
			return;
		}

		$this->outputFile( $path_to_output_file, $input_file_contents );
	}

	private function processBulkRedirects( String $redirect_list, String $path_to_output_directory, int $default_redirect_code = 307 )
	{
		echo "Processing redirection list..." . PHP_EOL . PHP_EOL;

		$lines = explode( PHP_EOL, $redirect_list );

		foreach( $lines as $line )
		{
			$line = trim( $line );

			if( $line === '' || substr( $line, 0, 1 ) === '#' )
				continue;

			$line = preg_replace( '/\s+#.*$/', '', $line );

			$line_parts = preg_split( '/\s+/', $line, 3, PREG_SPLIT_NO_EMPTY );

			if( ! $line_parts || empty( $line_parts ) )
				continue;

			if( count( $line_parts ) < 2 )
			{
				echo "Skipping redirection due to missing destination: " . $line_parts[ 0 ] . PHP_EOL;
				continue;
			}

			[ $oldPath, $newDestination ] = $line_parts;

			$redirect_code = isset( $line_parts[ 2 ] ) && is_numeric( $line_parts[ 2 ] ) ? ( int ) $line_parts[ 2 ] : $default_redirect_code;

			if( ! in_array( $redirect_code, [ 301, 302, 307, 308 ], true ) )
			{
				echo "Invalid redirect code (" . $redirect_code . "), using default code (" . $default_redirect_code . ")." . PHP_EOL;
				$redirect_code = $default_redirect_code;
			}

			if( substr( $oldPath, 0, 1 ) !== '/' && substr( $newDestination, 0, 1 ) !== '/' && substr( $newDestination, 0, 7 ) !== 'http://' && substr( $newDestination, 0, 8 ) !== 'https://' )
			{
				echo "Skipping malformatted redirection: " . $oldPath . " -> " . $newDestination . PHP_EOL;
				continue;
			}

			$filePath = $path_to_output_directory . DIRECTORY_SEPARATOR . $oldPath;

			if( strpos( $filePath, '.' ) === false )
				$filePath = $filePath . DIRECTORY_SEPARATOR . 'index.html';
			
			$this->processRedirection( $filePath, $oldPath, $newDestination );

			if( $this->generate_standard_redirects_file )
				$this->generateStandardRedirectsFile( $oldPath, $newDestination, $redirect_code );
			if( $this->generate_htaccess_redirections )
				$this->generateHtaccessRedirections( $oldPath, $newDestination, $redirect_code );
		}

		echo PHP_EOL . "Redirection list processed!" . PHP_EOL . PHP_EOL;
	}

	private function processRedirection( String $filePath, String $oldPath, String $newDestination )
	{
		// Ensure the directory exists
		$fileDir = dirname( $filePath );

		if ( ! is_dir( $fileDir ) )
		{
			mkdir( $fileDir, 0755, true );
		}
		
		// Create the redirection HTML file
		$htmlContent = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="refresh" content="0; url='$newDestination'" />
	<title>Redirecting...</title>
</head>

<body>
	<p>If you are not redirected, <a href="$newDestination">click here</a>.</p>
</body>
</html>

HTML;

		$source_dir_path = $this->test_mode ? $this->test_mode_input_dir_path : $this->source_dir_path;

		if( is_file( $source_dir_path . DIRECTORY_SEPARATOR . $this->redirection_template_filename ) )
		{
			$htmlContent = file_get_contents( $source_dir_path . DIRECTORY_SEPARATOR . $this->redirection_template_filename );
			$htmlContent = str_replace( [ '$newDestination', '$oldPath' ], [ $newDestination, $oldPath ], $htmlContent );
		}
		
		if( $this->minify_html === true )
			$htmlContent = $this->minifyHTML( $htmlContent );

		if( $this->test_mode )
		{
			$this->prepareForTest( $htmlContent, $filePath );
			echo "Redirect generated for $oldPath to $newDestination\n";
			return;
		}

		$this->outputFile( $filePath, $htmlContent );
		
		echo "Redirect generated for $oldPath to $newDestination\n";
	}

	private function generateStandardRedirectsFile( String $oldPath, String $newDestination, int $redirect_code )
	{
		$fileName = '_redirects';
		$inputFilePath = $this->source_dir_path . DIRECTORY_SEPARATOR . $fileName;
		$outputFilePath = $this->output_dir_path . DIRECTORY_SEPARATOR . $fileName;
		
		if( $this->test_mode && $this->test_mode_input_dir_path )
			$inputFilePath = $this->test_mode_input_dir_path . DIRECTORY_SEPARATOR . $fileName;
		if( $this->test_mode && $this->test_mode_output_dir_path )
			$outputFilePath = $this->test_mode_output_dir_path . DIRECTORY_SEPARATOR . $fileName;

		echo "Generating redirect for " . $fileName . " file." . PHP_EOL;

		$file_contents = '';

		if( is_file( $outputFilePath ) )
			$file_contents = file_get_contents( $outputFilePath ) . PHP_EOL;
		else if( ! is_file( $outputFilePath ) && is_file( $inputFilePath ) )
			$file_contents = file_get_contents( $inputFilePath ) . PHP_EOL;

		$file_contents .= $oldPath . ' ' . $newDestination . ' ' . $redirect_code;

		$this->outputFile( $outputFilePath, $file_contents );
	}

	private function generateHtaccessRedirections( String $oldPath, String $newDestination, int $redirect_code )
	{
		$fileName = '.htaccess';
		$inputFilePath = $this->source_dir_path . DIRECTORY_SEPARATOR . $fileName;
		$outputFilePath = $this->output_dir_path . DIRECTORY_SEPARATOR . $fileName;

		if( $this->test_mode && $this->test_mode_input_dir_path )
			$inputFilePath = $this->test_mode_input_dir_path . DIRECTORY_SEPARATOR . $fileName;
		if( $this->test_mode && $this->test_mode_output_dir_path )
			$outputFilePath = $this->test_mode_output_dir_path . DIRECTORY_SEPARATOR . $fileName;

		$file_contents = '';

		if( is_file( $outputFilePath ) )
			$file_contents = file_get_contents( $outputFilePath ) . PHP_EOL;
		else if( ! is_file( $outputFilePath ) && is_file( $inputFilePath ) )
			$file_contents = file_get_contents( $inputFilePath ) . PHP_EOL;

		$begin = '# BEGIN StaticPHP Bulk Redirects';
		$end = '# END StaticPHP Bulk Redirects';
		$blockPattern = '/' . preg_quote( $begin, '/' ) . '.*?' . preg_quote( $end, '/' ) . '/s';

		$existingRules = [];
		$pre = $file_contents;
		$hasBlock = preg_match( $blockPattern, $file_contents, $m ) === 1;

		if( $hasBlock )
		{
			$block = $m[ 0 ];

			if( preg_match_all( '/^\s*RewriteRule\s+(\S+)\s+(\S+)\s+\[R=(\d{3}),END\]\s*$/m', $block, $mm, PREG_SET_ORDER ) )
			{
				foreach( $mm as $match )
				{
					$pattern = $match[1];

					$pattern = preg_replace( '/^\^|\$$/', '', $pattern );

					$pattern = preg_replace( '/\\\\(.)/', '$1', $pattern );

					$dest = $match[ 2 ];
					$rcode = ( int ) $match[ 3 ];

					$p = $pattern;
					
					if(  strlen( $p ) >= 2 && $p[ 0 ] === '^' )
					{
						$p = substr( $p, 1 );
					}

					if( substr( $p, -1 ) === '$' )
					{
						$p = substr( $p, 0, -1 );
					}

					$p = str_replace( [ '\/' ], [ '/' ], $p );
					
					$fromKey = '/' . ltrim( $p, '/' );

					$existingRules[ $fromKey ] = [ 'to' => $dest, 'code' => $rcode ];
				}
			}

			$pre = preg_replace( $blockPattern, '', $file_contents, 1 );
		}

		$existingRules[ $oldPath ] = [ 'to' => $newDestination, 'code' => $redirect_code ];

		ksort( $existingRules, SORT_STRING );

		$lines = [];
		$lines[] = $begin;
		$lines[] = '# Managed by StaticPHP. There is no need to manually edit between these markers.';
		$lines[] = '';
		$lines[] = '<IfModule mod_rewrite.c>';
		$lines[] = "\tRewriteEngine On";

		foreach( $existingRules as $f => $info )
		{
			$dest = $info[ 'to' ];
			$rc = $info[ 'code' ];

			$pattern = '^' . preg_quote( ltrim( $f, '/' ), '#' ) . '$';

			$lines[] = "\t" . sprintf( 'RewriteRule %s %s [R=%d,END]', $pattern, $dest, $rc );
		}

		$lines[] = '</IfModule>';
		$lines[] = '';
		$lines[] = $end;
		$newBlock = implode( PHP_EOL, $lines ) . PHP_EOL;

		$pre = rtrim( $pre );

		if( $pre )
			$pre .= PHP_EOL . PHP_EOL;

		$newContents = $pre . $newBlock;

		$this->outputFile( $outputFilePath, $newContents );
	}

	private function processFunctionalBlocks( String $content, array $metadata )
	{
		echo "Processing Functional Blocks...\n";

		$delimiter = $this->metaDataDelimiter;

		$pattern = '/' . preg_quote($delimiter) . ' (\w+)\(([^)]*)\) ' . preg_quote($delimiter) . '(.*?)' . preg_quote($delimiter) . ' end\1 ' . preg_quote($delimiter) . '/s';

		$output = preg_replace_callback(
			$pattern, function( $matches ) use ( $delimiter, $metadata )
			{
				$funcName = $matches[ 1 ];
				$paramStr = $matches[ 2 ];
				$blockContent = $matches[ 3 ];

				switch( $funcName )
				{
					case 'loop':
						$blockOutput = $this->processLoopFunctionalBlock( $this->parseFunctionalBlockParameters( $paramStr ), $blockContent );

						if( $blockOutput !== null && $blockOutput !== "" )
						{
							return $blockOutput; // Replaced Content
						}

						break;
					case 'if':
						$blockOutput = $this->processIfFunctionalBlock( $paramStr, $blockContent, $metadata );

						if( $blockOutput !== null )
						{
							return $blockOutput; // Replaced Content
						}

						break;
				}

				return $matches[ 0 ]; // Original Content
			},
			$content
		);

		echo "...Functional Blocks Processed." . PHP_EOL;

		return $output;
	}

	private function processLoopFunctionalBlock( array $params, String $loopContent )
	{
		if( ! isset( $params[ 'dir' ] ) || ! is_dir( $params[ 'dir' ] ) )
		{
			return null;
		}

		echo "Processing Loop Functional Block..." . PHP_EOL;

		$dir = __DIR__ . DIRECTORY_SEPARATOR . $params[ 'dir' ];

		$dir = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $dir );

		$output = array();

		$output = $this->processLoopDir( $dir, $params, $loopContent, $output );

		if( isset( $params[ 'json' ] ) )
		{
			$jsonFilePath = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $params[ 'json' ] );
			
			$jsonFilePathParts = explode( DIRECTORY_SEPARATOR, $jsonFilePath );
			
			$currentJsonFilePath = "";
			
			for( $cjfp = 0; $cjfp < count( $jsonFilePathParts ) -1; $cjfp++ )
			{
				$currentJsonFilePath .= $jsonFilePathParts[ $cjfp ] . DIRECTORY_SEPARATOR;
				
				if( ! is_dir( $currentJsonFilePath ) && $cjfp != count( $jsonFilePathParts ) -1 )
				{
					mkdir( $currentJsonFilePath );
				}
			}
			
			if( $this->test_mode )
			{
				$this->prepareForTest( json_encode( $output ), $jsonFilePath );
			}
			else
			{
				echo "Outputting JSON File: " . $jsonFilePath . PHP_EOL;
				file_put_contents( $jsonFilePath, json_encode( $output ) );
				echo "JSON File Complete.\n";
			}
		}

		$output_str = "";

		foreach( $output as $output_item )
		{
			$output_str .= $output_item['outputContent'];
		}

		echo "...Loop Functional Block Processed." . PHP_EOL;

		return $output_str;
	}

	private function processIfFunctionalBlock( String $paramStr, String $content, array $metadata )
	{
		echo "Processing If Functional Block..." . PHP_EOL;

		$condition_state = true;

		$params = preg_split( "/(\s*)(&&)(\s*)/", $paramStr );

		foreach( $params as $param )
		{
			$param = trim( $param );

			if( strpos( $param, '==' ) )
			{
				$param = preg_split( "/(\s*)(==)(\s*)/", $param );
				$param_key = $param[ 0 ];
				$param_value = $param[ 1 ];

				if( ! array_key_exists( $param_key, $metadata ) )
				{
					$condition_state = false;
				}

				if( substr( trim( $param_value ), 0, 1 ) != "\"" && substr( trim( $param_value ), -1, 1 ) != "\"" )
				{
					$condition_state = false;
				}

				if( array_key_exists( $param_key, $metadata ) && $metadata[ $param_key ] != substr( $param_value, 1, -1 ) )
				{
					$condition_state = false;
				}
			}
			else
			{
				if( ! array_key_exists( trim( $param ), $metadata ) )
				{
					$condition_state = false;
				}
			}
		}

		echo "...If Functional Block Processed." . PHP_EOL;

		if( $condition_state )
			return $content;
		return "";
	}

	private function processLoopDir( String $dirPath, array $params, String $loopContent, array $output = array() )
	{
		if( ! is_dir( $dirPath ) )
			return;

		echo "Processing Loop Directory: " . $dirPath . PHP_EOL;

		$dirContents = scandir( $dirPath );

		if( isset( $params['sort'] ) && $params['sort'] == "ascending" )
		{
			sort( $dirContents );
		}
		elseif( isset( $params['sort'] ) && $params['sort'] == "descending" )
		{
			rsort( $dirContents );
		}

		foreach( $dirContents as $dirItem )
		{
			if( $dirItem === '.' || $dirItem === '..' )
			{
				continue;
			}

			$dirItemPath = $dirPath . DIRECTORY_SEPARATOR . $dirItem;

			if( is_dir( $dirItemPath ) )
			{
				$output = $this->processLoopDir( $dirItemPath, $params, $loopContent, $output );
				continue;
			}

			if( ! is_file( $dirItemPath ) )
			{
				continue;
			}

			if( substr( $dirItem, -4 ) !== ".php" && substr( $dirItem, -5 ) !== ".html" )
			{
				continue;
			}

			if( is_array( $this->items_to_ignore ) )
			{
				foreach( $this->items_to_ignore as $item_to_ignore )
				{
					if( $item_to_ignore != "" && strpos( $dirItemPath, $item_to_ignore ) !== false )
					{
						echo "Loop Ignoring Item: " . $dirItemPath . PHP_EOL;
						continue( 2 );
					}
				}
			}

			if( isset( $params[ 'ignores' ] ) )
			{
				$ignore_items = explode( ";", $params[ 'ignores' ] );

				foreach( $ignore_items as $ignore_item )
				{
					$ignore_item = trim( $ignore_item );
					
					if( strpos( $dirItemPath, $ignore_item ) !== false )
					{
						echo "Loop Ignoring Item: " . $dirItemPath . PHP_EOL;
						continue( 2 );
					}
				}
			}

			
			$fileContents = file_get_contents( $dirItemPath );
			
			$thisLoopContent = $loopContent;
			
			$metadata = array();
			
			$this->processMetaData( $this->metaDataDelimiter, $fileContents, $metadata, $fileContents );

			unset( $metadata['staticphp_path'] );

			$source_dir_path = $this->test_mode ? $this->test_mode_input_dir_path : $this->source_dir_path;
			$output_dir_path = $this->test_mode ? $this->test_mode_output_dir_path : $this->output_dir_path;

			$source_dir_path = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $source_dir_path );
			$output_dir_path = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $output_dir_path );
			
			$fileOutputPath = str_replace( [ $source_dir_path, ".php" ], [ $output_dir_path, ".html" ], $dirItemPath );

			$fileURI = $fileOutputPath;

			if( ! isset( $friendly_urls ) )
				$friendly_urls = $this->friendly_urls;
			
			$this->processOutputPath( $fileURI, $metadata, $friendly_urls );

			$fileURI = str_replace( [ $output_dir_path, "index.html", "\\" ], [ "", "", "/" ], $fileURI );
			
			$metadata[ 'uri' ] = $fileURI;
			
			$this->processMetaDataPlaceHolders( $this->metaDataDelimiter, $loopContent, $metadata, $thisLoopContent, 'loop' );
			
			if( isset( $params[ 'content_placeholder' ] ) && $params[ 'content_placeholder' ] )
			{
				$thisLoopContent = str_replace( $params[ 'content_placeholder' ], $fileContents, $thisLoopContent );
			}

			$toOutput['metadata'] = $metadata;
			$toOutput['fileContents'] = $fileContents;
			$toOutput['outputContent'] = $thisLoopContent;

			$output[] = $toOutput;

			echo "...Loop Directory Processed." . PHP_EOL;
		}

		return $output;
	}

	private function parseFunctionalBlockParameters( String $paramStr )
	{
		$params = [];
		$paramPairs = explode( ',', $paramStr );
		
		foreach( $paramPairs as $pair )
		{
			list( $key, $value ) = explode( '=', $pair, 2 );
			$params[ trim( $key ) ] = trim( trim( $value ), "'\"" );
		}
		
		return $params;
	}

	private function minifyHTML( String $html )
	{
		echo "Minifying HTML..." . PHP_EOL;

		// Convert all HTML end of lines to use system specific end of lines using PHP_EOL
		$html = $this->convertEndOfLines( $html );

		$preserved_html_tags = array();

		// Extract HTML tags to be preserved
		if( count( $this->minify_html_tags_to_preserve ) >= 1 )
		{
			foreach( $this->minify_html_tags_to_preserve as $tag_to_preserve )
			{
				preg_match_all( "#<{$tag_to_preserve}[^>]*>.*?</{$tag_to_preserve}>#is", $html, $preserve_tag_matches );
				$preserve_tag_matches = isset( $preserve_tag_matches[ 0 ] ) ? $preserve_tag_matches[ 0 ] : array();

				foreach( $preserve_tag_matches as $preserve_tag_num => $preserve_tag_match )
				{
					$preserved_tag_key = "__STATICPHP_PRESERVED_{$tag_to_preserve}_CODE_BLOCK_{$preserve_tag_num}__";
					$preserved_html_tags[ $preserved_tag_key ] = $preserve_tag_match;
					$html = str_replace( $preserve_tag_match, $preserved_tag_key, $html );
				}
			}
		}

		// Remove comments
		$html = preg_replace( '/<!--(?!<!)[^\[>][\s\S]*?-->/s', '', $html );
		
		// Remove whitespace between tags
		$html = preg_replace( '/>\s+</', '><', $html );
		
		// Remove unnecessary spaces
		$html = preg_replace( '/\s+/', ' ', $html );

		// Restore preserved HTML tags
		foreach( $preserved_html_tags as $preserved_tag_key => $preserved_tag )
		{
			$html = str_replace( $preserved_tag_key, $preserved_tag, $html );
		}
		
		return $html;
	}

	private function minifyCSS( String $css )
	{
		echo "Minifying CSS..." . PHP_EOL;

		// Remove comments
		$css = preg_replace( '!/\*.*?\*/!s', '', $css );

		// Remove spaces, newlines, and tabs
		$css = preg_replace( '/\s*([{}|:;,])\s*/', '$1', $css );

		// Remove trailing semicolons in CSS blocks
		$css = preg_replace( '/;}/', '}', $css );

		// Remove extra whitespace
		$css = preg_replace( '/\s+/', ' ', $css );

		return $css;
	}

	private function minifyJS( String $js )
	{
		echo "JavaScript Minification is disabled until a bug in the minification process can be fixed." . PHP_EOL;

		return $js;
	}	

	private function convertEndOfLines( $text )
	{
		return preg_replace( "/\r\n|\r|\n/", PHP_EOL, $text );
	}

	private function getRemoteContentFromURL( String $URL )
	{
		echo "Attempting to fetch from remote URL: " . $URL . PHP_EOL;

		$remote_file_headers = @get_headers( $URL );

		if( ! $remote_file_headers && strpos( $remote_file_headers[ 0 ], '200' ) === false )
		{
			echo "Unable to fetch from remote URL. Remote content is either unavailable or returned non-200 HTTP code." . PHP_EOL;
			return "";
		}

		$remote_content = @file_get_contents( $URL );

		if( $remote_content === false )
		{
			echo "Unable to fetch from remote URL. Error: " . error_get_last() . PHP_EOL;
			return "";
		}

		return $remote_content;
	}

	private function convertMarkdownToHTML( String $markdown, array $metadata, bool $friendly_urls )
	{
		$lines = explode( PHP_EOL, $markdown );

		$codeblockName = "";
		$isCodeblock = false;

		$listStarts = array();
		$listEnds = array();
		$inList = false;
		$endOfList = false;

		// Start of List Detection Code
		for( $l = 0; $l < count( $lines ); $l++ )
		{
			if( preg_match( "/^\s*[-*+]\s+/", $lines[ $l ] ) )
			{
				if( ! $inList )
				{
					$listStarts[] = $l;
					$inList = true;
				}
 			}
			else
			{
				if( $inList )
				{
					$listEnds[] = $l - 1;
					$inList = false;
				}
			}
		}

		if( $inList )
		{
			$listEnds[] = $l - 1;
		}
		// End of List Detection Code

		for( $l = 0; $l < count( $lines ); $l++ )
		{
			if( preg_match( "/\`\`\`(.*)/", $lines[ $l ], $matches ) )
			{
				if( ! $isCodeblock )
				{
					$codeblockName = $matches[ 1 ];
					$isCodeblock = true;

					if( $codeblockName )
						$lines[ $l ] = preg_replace( "/\`\`\`(.*)/", "<pre><code class=\"codeblock codeblock-" . $codeblockName . "\">", $lines[ $l ] );
					else
						$lines[ $l ] = preg_replace( "/\`\`\`(.*)/", "<pre><code class=\"codeblock\">", $lines[ $l ] );

					continue;
				}
			}

			if( preg_match( "/\`\`\`/", $lines[ $l ], $matches ) )
			{
				if( $isCodeblock )
				{
					$lines[ $l ] = preg_replace( "/\`\`\`/", "</code></pre>", $lines[ $l ] );
					$isCodeblock = false;
					continue;
				}
			}

			if( $isCodeblock )
			{
				$lines[ $l ] = htmlentities( $lines[ $l ] );
				continue;
			}
			
			$inlineCodeTokens = array();
			$inlineCodeIndex = 0;
			
			// First: match and replace double backtick inline code blocks (e.g. `` ` ``)
			if( preg_match_all( '/``(.*?)``/', $lines[$l], $matches, PREG_SET_ORDER ) )
			{
				foreach( $matches as $match )
				{
					$token = '{{INLINECODE' . $inlineCodeIndex++ . '}}';
					$inlineCodeTokens[$token] = '<code>' . htmlentities( $match[ 1 ] ) . '</code>';
					$lines[ $l ] = str_replace( $match[ 0 ], $token, $lines[ $l ] );
				}
			}

			// Second: match and replace single backtick inline code blocks (e.g. `code`)
			if( preg_match_all( '/`(.*?)`/', $lines[$l], $matches, PREG_SET_ORDER ) )
			{
				foreach( $matches as $match )
				{
					$token = '{{INLINECODE' . $inlineCodeIndex++ . '}}';
					$inlineCodeTokens[ $token ] = '<code>' . htmlentities( $match[ 1 ] ) . '</code>';
					$lines[$l] = str_replace( $match[ 0 ], $token, $lines[ $l ] );
				}
			}

			if( preg_match( "/^\s*-\s+(.*)/", $lines[ $l ], $matches ) )
			{
				$lines[ $l ] = "<li>" . htmlspecialchars( $matches[ 1 ] ) . "</li>";
			}

			if( in_array( $l, $listStarts ) )
			{
				$lines[ $l ] = '<ul>' . PHP_EOL . $lines[ $l ];
				$inList = true;
			}

			if( in_array( $l, $listEnds ) )
			{
				$lines[ $l ] .= PHP_EOL . '</ul>';
				$endOfList = true;
			}

			if( preg_match( "/(#{6}\s)(.*)/", $lines[ $l ] ) )
			{
				$lines[ $l ] = preg_replace( "/(#{6}\s)(.*)/", "<h6>$2</h6>", $lines[ $l ] );
				continue;
			}
			
			if( preg_match( "/(#{5}\s)(.*)/", $lines[ $l ] ) )
			{
				$lines[ $l ] = preg_replace( "/(#{5}\s)(.*)/", "<h5>$2</h5>", $lines[ $l ] );
				continue;
			}

			if( preg_match( "/(#{4}\s)(.*)/", $lines[ $l ] ) )
			{
				$lines[ $l ] = preg_replace( "/(#{4}\s)(.*)/", "<h4>$2</h4>", $lines[ $l ] );
				continue;
			}

			if( preg_match( "/(#{3}\s)(.*)/", $lines[ $l ] ) )
			{
				$lines[ $l ] = preg_replace( "/(#{3}\s)(.*)/", "<h3>$2</h3>", $lines[ $l ] );
				continue;
			}

			if( preg_match( "/(#{2}\s)(.*)/", $lines[ $l ] ) )
			{
				$lines[ $l ] = preg_replace( "/(#{2}\s)(.*)/", "<h2>$2</h2>", $lines[ $l ] );
				continue;
			}

			if( preg_match( "/(#{1}\s)(.*)/", $lines[ $l ] ) )
			{
				$lines[ $l ] = preg_replace( "/(#{1}\s)(.*)/", "<h1>$2</h1>", $lines[ $l ] );
				continue;
			}

			if( preg_match( "/^\s*(-{3,}|\*{3,}|_{3,})\s*$/", $lines[ $l ] ) )
			{
				$lines[ $l ] = preg_replace( "/^\s*(-{3,}|\*{3,}|_{3,})\s*$/", "<hr>", $lines[ $l ] );
				continue;
			}

			$lines[ $l ] = preg_replace( "/\*\*([^\*]+)\*\*/", "<strong>$1</strong>", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\_\_([^\_]+)\_\_/", "<strong>$1</strong>", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\*([^\*]+)\*/", "<em>$1</em>", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\_([^\_]+)\_/", "<em>$1</em>", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\~\~([^\~]+)\~\~/", "<del>$1</del>", $lines[ $l ] );

			$lines[ $l ] = preg_replace( "/\!\[([^\]]+)\]\(([^\"\)]+) \"([^\"]+)\"\)/", "<img src=\"$2\" alt=\"$1\" title=\"$3\">", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\!\[([^\]]+)\]\(([^\"\)]+)\)/", "<img src=\"$2\" alt=\"$1\">", $lines[ $l ] );

			$lines[ $l ] = preg_replace_callback
			(
				'/\[([^\]]+)\]\(([^)\s]+)(?:\s+"([^"]+)")?\)/',
				function( $matches )
				{
					$text  = $matches[ 1 ];
					$href  = $matches[ 2 ];
					$title = isset( $matches[ 3 ] ) ? ' title="' . htmlspecialchars( $matches[ 3 ] ) . '"' : '';
					$external = false;

					if( strpos( $href, '://' ) )
						$external = true;

					return '<a href="' . htmlspecialchars( $href ) . '"' . $title . ( $external ? ' target="_blank" rel="noopener noreferrer"' : '' ) . '>' . htmlspecialchars( $text ) . '</a>';
				},
				$lines[ $l ]
			);

			if( $lines[ $l ] == "" )
				continue;

			if( ! $inList )
			{
				if( $l != 0 && $lines[ $l -1 ] != "" && substr( $lines[ $l -1 ], -4 ) == "</p>" )
					$lines[ $l -1 ] = substr( $lines[ $l -1 ], 0, -4 ) . "<br>";
				elseif( $l == 0 || ( $l != 0 && substr( $lines[ $l -1 ], -4 ) != "<br>" ) )
					$lines[ $l ] = "<p>" . $lines[ $l ];

				$lines[ $l ] .= "</p>";
			}
			
			if( ! empty( $inlineCodeTokens ) )
			{
				$lines[ $l ] = str_replace( array_keys( $inlineCodeTokens ), array_values( $inlineCodeTokens ), $lines[ $l ] );
			}

			if( $endOfList )
			{
				$inList = false;
				$endOfList = false;
			}
		}

		$html = implode( PHP_EOL, $lines );

		return $html;
	}

	private function prepareForTest( $input_contents, $path_to_output_file )
	{
		echo "Preparing for test..." . PHP_EOL;

		$path_to_output_file = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $path_to_output_file );

		if( substr( $path_to_output_file, 0, strlen( __DIR__ . DIRECTORY_SEPARATOR ) ) != __DIR__ . DIRECTORY_SEPARATOR )
			$path_to_output_file = __DIR__ . DIRECTORY_SEPARATOR . $path_to_output_file;
		
		echo "Path to Output file: " . $path_to_output_file . PHP_EOL;

		$expected_file_path = str_replace( $this->test_mode_output_dir_path, $this->test_mode_expected_dir_path, $path_to_output_file );

		if( ! is_file( $expected_file_path ) )
		{
			echo "ERROR: Expected file missing: " . $expected_file_path . PHP_EOL;
			$this->runTest( $input_contents, "", $path_to_output_file );
			return;
		}
		
		$expected_file_contents = file_get_contents( $expected_file_path );

		$this->runTest( $input_contents, $expected_file_contents, $path_to_output_file );
	}

	private function runTest( $input_contents, $expected_contents, $path_to_output_file )
	{
		echo "Running test..." . PHP_EOL;

		$path_to_output_dir = substr( $path_to_output_file, 0, strrpos( $path_to_output_file, DIRECTORY_SEPARATOR ) + 1 );

		$output_file_name = substr( $path_to_output_file, strrpos( $path_to_output_file, DIRECTORY_SEPARATOR ) + 1 );

		$input_contents = $this->convertEndOfLines( $input_contents );

		$expected_contents = $this->convertEndOfLines( $expected_contents );

		if( $input_contents != $expected_contents )
		{
			if( $expected_contents == "" )
			{
				$path_to_output_file = $path_to_output_dir . "UNKNOWN." . $output_file_name;
				$this->tests_unknown[] = $path_to_output_file;
			}
			else
			{
				$path_to_output_file = $path_to_output_dir . "FAILED." . $output_file_name;
				$this->tests_failed[] = $path_to_output_file;
			}

			$this->outputFile( $path_to_output_file, $input_contents );

			echo "TEST FAILED: Check output file!" . PHP_EOL;

			return;
		}

		$path_to_output_file = $path_to_output_dir . "PASSED." . $output_file_name;
		$this->tests_successful[] = $path_to_output_file;

		$this->outputFile( $path_to_output_file, $input_contents );

		echo "TEST PASSED!" . PHP_EOL;

		return;
	}
}

function detect_and_parse_cli_args_into_configurable_options( array $args )
{
	if( count( $args ) < 1 )
		return;

	// Detect Named Flags
	if( substr( $args[ 0 ], 0, 2 ) == "--" )
	{
		return parse_cli_named_flags_into_configurable_options( $args );
	}

	// Otherwise assume normal cli args
	return parse_cli_args_into_configurable_options( $args );
}

function parse_cli_named_flags_into_configurable_options( array $args )
{
	$configurable_options = array();

	foreach( $args as $arg )
	{
		if( substr( $arg, 0, 2 ) == "--" )
			$arg = substr( $arg, 2 );
		if( ! strpos( $arg, "=" ) )
			continue;

		$arg = explode( "=", $arg, 2 );

		$configurable_key = $arg[ 0 ];
		$configurable_value = $arg[ 1 ];

		$configurable_options[ $configurable_key ] = $configurable_value;
	}

	return $configurable_options;
}

function parse_cli_args_into_configurable_options( array $args )
{
	$configurable_options = array();

	if( isset( $args[ 0 ] ) )
		$configurable_options[ 'source_dir_path' ] = $args[ 0 ];
	if( isset( $args[ 1 ] ) )
		$configurable_options[ 'output_dir_path' ] = $args[ 1 ];
	if( isset( $args[ 2 ] ) )
		$configurable_options[ 'items_to_ignore' ] = $args[ 2 ];
	if( isset( $args[ 3 ] ) )
		$configurable_options[ 'friendly_urls '] = $args[ 3 ];
	if( isset( $args[ 4 ] ) )
		$configurable_options[ 'metadata_delimiter' ] = $args[ 4 ];
	if( isset( $args[ 5 ] ) )
		$configurable_options[ 'minify_html' ] = $args[ 5 ];
	if( isset( $args[ 6 ] ) )
		$configurable_options[ 'minify_css' ] = $args[ 6 ];
	if( isset( $args[ 7 ] ) )
		$configurable_options[ 'minify_js' ] = $args[ 7 ];
	if( isset( $args[ 8 ] ) )
		$configurable_options[ 'minify_html_tags_to_preserve' ] = $args[ 8 ];
	if( isset( $args[ 9 ] ) )
		$configurable_options[ 'bulk_redirects_filename' ] = $args[ 9 ];
	if( isset( $args[ 10 ] ) )
		$configurable_options[ 'redirection_template_filename' ] = $args[ 10 ];
	if( isset( $args[ 11 ] ) )
		$configurable_options[ 'minify_css_inplace' ] = $args[ 11 ];
	if( isset( $args[ 12 ] ) )
		$configurable_options[ 'items_to_passthrough' ] = $args[ 12 ];

	return $configurable_options;
}

if( isset( $argv[ 0 ] ) && basename( $argv[ 0 ] ) == basename( __FILE__ ) )
{
	$configurable_options = array();
	
	unset( $argv[ 0 ] );
	$argv = array_values( $argv );
	
	if( count( $argv ) >= 1 )
	{
		$configurable_options = detect_and_parse_cli_args_into_configurable_options( $argv );
	}
	
	new StaticPHP( $configurable_options );
}

