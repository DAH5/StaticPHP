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
		// End Arguments Method

		// Ensure Special Files are Ignored
		if( ! in_array( $this->redirection_template_filename, $this->items_to_ignore ) )
			$this->items_to_ignore[] = $this->redirection_template_filename;

		$this->source_dir_path = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $this->source_dir_path );
		$this->output_dir_path = str_replace( [ "\\", "/" ], DIRECTORY_SEPARATOR, $this->output_dir_path );

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

					$css = $this->minifyCSS( $css );

					$this->outputFile( $path_to_output_directory_item, $css );

					continue;
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
		
		if( count( $input_lines ) > 0 && trim( $input_lines[ 0 ] ) == $delimiter )
		{
			echo "Processing MetaData..." . PHP_EOL . PHP_EOL;
			
			unset( $input_lines[ 0 ] );
			
			for( $line_number = 1; $line_number <= count( $input_lines ); $line_number++ )
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
		// Check if a base layout path is defined in metadata.
		if( isset( $metadata['layout'] ) )
		{
			// Get full path to layout file assuming it is relative to StaticPHP.
			$layout_path = __DIR__ . DIRECTORY_SEPARATOR . $metadata['layout'];
			
			if( $layout_path && is_file( $layout_path ) )
			{
				echo "Processing layout file: " . $layout_path . PHP_EOL;
				
				// Get contents of base layout file.
				$layout_contents = file_get_contents( $layout_path );
				// Get layout metadata.
				$layout_metadata = array();
				$this->processMetaData( $metaDataDelimiter, $layout_contents, $layout_metadata, $layout_contents );
				// Update metadata with a merged version of the layout metadata and the current metadata, giving priority to current where conflicting keys exist.
				$metadata = array_merge( $layout_metadata, $metadata );
			}
		}
	}
	
	private function processContentPlaceHolder( array $metadata, string &$file_contents, string $layout_contents )
	{
		// Check for a content placeholder defined in metadata (usually layout metadata).
		if( isset( $metadata['content_placeholder'] ) && trim( $metadata['content_placeholder'] ) )
		{
			echo "Replacing content placeholder with page content...\n";
			// Update current page content with the layout content, replacing the placeholder with the content of current page.
			$file_contents = str_replace( trim( $metadata['content_placeholder'] ), $file_contents, $layout_contents );
		}
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
		echo "Outputting File: "  . $path_to_file . PHP_EOL;
		
		@chmod( $path_to_file, 0755 );
		$open_file_for_writing = fopen( $path_to_file, "w" );
		fputs( $open_file_for_writing, $file_contents, strlen( $file_contents ) );
		fclose( $open_file_for_writing );
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
		
		$this->outputFile( $path_to_output_file, $input_file_contents );
	}

	private function processBulkRedirects( String $redirect_list, String $path_to_output_directory )
	{
		//echo "path_to_output_directory: " . $path_to_output_directory . "\n";
		//return;

		echo "Processing redirection list..." . PHP_EOL . PHP_EOL;

		// Split the contents into lines
		$lines = explode( PHP_EOL, $redirect_list );
    
		// Loop through each line
		foreach( $lines as $line )
		{
			// Skip empty lines or lines starting with a comment (#)
			$line = trim( $line );

			if( empty( $line ) || strpos( $line, '#' ) === 0 )
			{
				continue;
			}
			
			// Split the line into the old path and new destination
			[ $oldPath, $newDestination ] = explode( ' ', $line, 2 );
			
			// Ensure both parts are present
			if( empty( $oldPath ) || empty( $newDestination ) )
			{
				echo "Invalid redirect entry: $line" . PHP_EOL;
				continue;
			}
			
			$filePath = $path_to_output_directory . DIRECTORY_SEPARATOR . $oldPath;

			if( strpos( $filePath, '.' ) === false )
				$filePath = $filePath . DIRECTORY_SEPARATOR . 'index.html';
			
			$this->processRedirection( $filePath, $oldPath, $newDestination );
		}

		echo "\nRedirection list processed!\n\n";
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

		if( is_file( $this->source_dir_path . DIRECTORY_SEPARATOR . $this->redirection_template_filename ) )
		{
			$htmlContent = file_get_contents( $this->source_dir_path . DIRECTORY_SEPARATOR . $this->redirection_template_filename );
			$htmlContent = str_replace( [ '$newDestination', '$oldPath' ], [ $newDestination, $oldPath ], $htmlContent );
		}
		
		if( $this->minify_html === true )
			$htmlContent = $this->minifyHTML( $htmlContent );

		$this->outputFile( $filePath, $htmlContent );
		
		echo "Redirect generated for $oldPath to $newDestination\n";
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
			
			echo "Outputting JSON File: " . $jsonFilePath . PHP_EOL;
			file_put_contents( $jsonFilePath, json_encode( $output ) );
			echo "JSON File Complete.\n";
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
			
			$fileOutputPath = str_replace( [ $this->source_dir_path, ".php" ], [ $this->output_dir_path, ".html" ], $dirItemPath );

			$fileURI = $fileOutputPath;

			if( ! isset( $friendly_urls ) )
				$friendly_urls = $this->friendly_urls;
			
			$this->processOutputPath( $fileURI, $metadata, $friendly_urls );

			$fileURI = str_replace( $this->output_dir_path, "", $fileURI );

			$fileURI = str_replace( [ "\\", "index.html" ], [ "/", "" ], $fileURI );
			
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

	private function convertMarkdownToHTML( String $markdown, array $metadata, bool $friendly_urls, String $path_to_output_file )
	{
		$lines = explode( PHP_EOL, $markdown );

		$codeblockName = "";
		$isCodeblock = false;

		for( $l = 0; $l < count( $lines ); $l++ )
		{
			if( preg_match( "/\`\`\`(.*)/", $lines[ $l ], $matches ) )
			{
				if( ! $isCodeblock )
				{
					$codeblockName = $matches[ 1 ];
					$isCodeblock = true;
					$lines[ $l ] = preg_replace( "/\`\`\`(.*)/", "<pre><code class=\"codeblock-" . $codeblockName . "\">", $lines[ $l ] );
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
			
			if( preg_match_all( "/\`([^\`]+)\`/", $lines[ $l ], $matches ) )
			{
				foreach( $matches[ 1 ] as $match )
				{
					$token = '{{INLINECODE' . $inlineCodeIndex++ . '}}';
					$inlineCodeTokens[ $token ] = '<code>' . htmlentities( $match ) . '</code>';
					$lines[ $l ] = str_replace( "`$match`", $token, $lines[ $l ] );
				}
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

			$lines[ $l ] = preg_replace( "/\*\*([^\*]+)\*\*/", "<strong>$1</strong>", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\_\_([^\_]+)\_\_/", "<strong>$1</strong>", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\*([^\*]+)\*/", "<em>$1</em>", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\_([^\_]+)\_/", "<em>$1</em>", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\~\~([^\~]+)\~\~/", "<del>$1</del>", $lines[ $l ] );

			$lines[ $l ] = preg_replace( "/\!\[([^\]]+)\]\(([^\"\)]+) \"([^\"]+)\"\)/", "<img src=\"$2\" alt=\"$1\" title=\"$3\">", $lines[ $l ] );
			$lines[ $l ] = preg_replace( "/\!\[([^\]]+)\]\(([^\"\)]+)\)/", "<img src=\"$2\" alt=\"$1\">", $lines[ $l ] );

			if( preg_match( "/\[([^\]]+)\]\(([^\"\)]+) \"([^\"]+)\"\)/", $lines[ $l ], $matches ) )
			{
				$text = $matches[ 1 ];
				$href = $matches[ 2 ];
				$title = $matches[ 3 ];
				
				$lines[ $l ] = preg_replace( "/\[([^\]]+)\]\(([^\"\)]+) \"([^\"]+)\"\)/", "<a href=\"" . $href . "\" title=\"" . $title . "\">" . $text . "</a>", $lines[ $l ] );
			}

			if( preg_match( "/\[([^\]]+)\]\(([^\"\)]+)\)/", $lines[ $l ], $matches ) )
			{
				$text = $matches[ 1 ];
				$href = $matches[ 2 ];

				$lines[ $l ] = preg_replace( "/\[([^\]]+)\]\(([^\"\)]+)\)/", "<a href=\"" . $href . "\">" . $text . "</a>", $lines[ $l ] );
			}

			if( $lines[ $l ] == "" )
				continue;

			if( $l != 0 && $lines[ $l -1 ] != "" )
				$lines[ $l -1 ] = substr( $lines[ $l -1 ], 0, -4 ) . "<br>";
			elseif( $l == 0 || ( $l != 0 && $lines[ $l -1 ] == "" ) )
				$lines[ $l ] = "<p>" . $lines[ $l ];

			$lines[ $l ] .= "</p>";
			
			if( ! empty( $inlineCodeTokens ) )
			{
				$lines[ $l ] = str_replace( array_keys( $inlineCodeTokens ), array_values( $inlineCodeTokens ), $lines[ $l ] );
			}
		}

		$html = implode( PHP_EOL, $lines );

		return $html;
	}
}

if( isset( $argv[ 0 ] ) && basename( $argv[ 0 ] ) == basename( __FILE__ ) )
{
	$configurable_options = array();
	
	unset( $argv[ 0 ] );
	$argv = array_values( $argv );
	$argc--;
	
	if( $argc >= 0 )
	{
		if( isset( $argv[ 0 ] ) )
			$configurable_options[ 'source_dir_path' ] = $argv[ 0 ];
		if( isset( $argv[ 1 ] ) )
			$configurable_options[ 'output_dir_path' ] = $argv[ 1 ];
		if( isset( $argv[ 2 ] ) )
			$configurable_options[ 'items_to_ignore' ] = $argv[ 2 ];
		if( isset( $argv[ 3 ] ) )
			$configurable_options[ 'friendly_urls '] = $argv[ 3 ];
		if( isset( $argv[ 4 ] ) )
			$configurable_options[ 'metadata_delimiter' ] = $argv[ 4 ];
		if( isset( $argv[ 5 ] ) )
			$configurable_options[ 'minify_html' ] = $argv[ 5 ];
		if( isset( $argv[ 6 ] ) )
			$configurable_options[ 'minify_css' ] = $argv[ 6 ];
		if( isset( $argv[ 7 ] ) )
			$configurable_options[ 'minify_js' ] = $argv[ 7 ];
		if( isset( $argv[ 8 ] ) )
			$configurable_options[ 'minify_html_tags_to_preserve' ] = $argv[ 8 ];
		if( isset( $argv[ 9 ] ) )
			$configurable_options[ 'bulk_redirects_filename' ] = $argv[ 9 ];
		if( isset( $argv[ 10 ] ) )
			$configurable_options[ 'redirection_template_filename' ] = $argv[ 10 ];
	}
	
	new StaticPHP( $configurable_options );
}

