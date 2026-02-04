/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
jQuery(document).ready(function($) {
    var page = 0; // Initialize the current page number
    var currentQuery = localStorage.getItem('searchQuery') || ''; // Initialize the current search query from localStorage
    var currentType = localStorage.getItem('searchType') || ''; // Initialize the current search type from localStorage
    var autoLoadMoreEnabled = localStorage.getItem('autoLoadMoreEnabled') === 'true'; // Initialize auto-load more flag
    var resultsThreshold = 5; // Threshold for the minimum number of results to trigger auto-load
    var totalMangaCount = 0; // Initialize the total manga count

    // Set the input fields with the retrieved values
    $('#search-query').val(currentQuery);
    $('#search-type').val(currentType);

    // Set the state of the auto-load checkbox based on saved setting
    $('#auto-load-more').prop('checked', autoLoadMoreEnabled);
    toggleLoadMoreButton(autoLoadMoreEnabled);

    // Attach or detach the scroll event handler based on auto-load more setting
    if (autoLoadMoreEnabled) {
        $(window).on('scroll', debounce(handleScroll, 200));
    } else {
        $(window).off('scroll', handleScroll);
    }

    // Save URL settings
    $('#save-url-settings').on('click', function() {
        var mangaFetchUrl = $('#manga-fetch-url').val(); // Get the manga fetch URL from the input field

        // Save the URL setting via AJAX
        $.ajax({
            url: madaraEnhancements.ajaxUrl,
            method: 'POST',
            data: {
                action: 'save_manga_fetch_url',
                manga_fetch_url: mangaFetchUrl,
                _ajax_nonce: madaraEnhancements.nonce
            },
            success: function(response) {
                if (response.success) {
                    alert('URL saved successfully!'); // Display success message
                } else {
                    alert('Failed to save URL: ' + response.data); // Display error message
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error); // Log the error to the console
                alert('Failed to save URL: ' + error); // Display error message
            }
        });
    });

    // Perform search
    $('#search-button').on('click', function() {
        currentQuery = $('#search-query').val(); // Get the search query from the input field
        currentType = $('#search-type').val(); // Get the search type from the dropdown
        page = 0; // Reset the page number
        totalMangaCount = 0; // Reset the total manga count

        // Save the search query, type, and page in localStorage
        localStorage.setItem('searchQuery', currentQuery);
        localStorage.setItem('searchType', currentType);
        localStorage.setItem('currentPage', page);

        // Clear the existing cache
        clearCache();

        // Perform the search via AJAX
        performSearch(currentQuery, currentType, page);
    });

    // Auto-load more manga if enabled
    $('#auto-load-more').on('change', function() {
        autoLoadMoreEnabled = $(this).is(':checked'); // Update the auto-load more flag
        localStorage.setItem('autoLoadMoreEnabled', autoLoadMoreEnabled); // Save the setting in local storage
        toggleLoadMoreButton(autoLoadMoreEnabled);

        // Attach or detach the scroll event handler based on auto-load more setting
        if (autoLoadMoreEnabled) {
            $(window).on('scroll', debounce(handleScroll, 200));
        } else {
            $(window).off('scroll', handleScroll);
        }
    });

    // Load more manga when the "Load More" button is clicked
    $('#load-more').on('click', function() {
        page++;
        localStorage.setItem('currentPage', page); // Save the current page in localStorage
        fetchMoreManga(page, currentQuery, currentType); // Fetch more manga using the updated page number
    });

    // Handle scroll for infinite loading
    function handleScroll() {
        if (autoLoadMoreEnabled && $(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            page++;
            localStorage.setItem('currentPage', page); // Save the current page in localStorage
            fetchMoreManga(page, currentQuery, currentType);
        }
    }

    // Debounce function to limit the rate at which a function can fire
    function debounce(func, wait) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                func.apply(context, args);
            }, wait);
        };
    }

    // Function to perform search via AJAX
    function performSearch(query, type, page) {
        console.log("Performing search with query:", query, "type:", type, "page:", page);
        $.ajax({
            url: madaraEnhancements.ajaxUrl,
            method: 'POST',
            data: {
                action: 'search_manga',
                query: query,
                type: type,
                _ajax_nonce: madaraEnhancements.nonce,
                page: page
            },
            success: function(response) {
                console.log("Search response:", response);
                if (response.success) {
                    var results = response.data;
                    if (results.length === 0) {
                        alert('No manga found for this search.');
                        return;
                    }
                    var mangaCache = JSON.parse(localStorage.getItem('mangaCache')) || [];
                    if (!Array.isArray(mangaCache)) {
                        mangaCache = [];
                    }
                    mangaCache = results; // Replace the cache with new results
                    localStorage.setItem('mangaCache', JSON.stringify(mangaCache)); // Save the updated cache in localStorage
                    totalMangaCount = mangaCache.length;
                    updateMangaTable(mangaCache); // Update the table with the search results

                    // Update the manga count display
                    $('#manga-count').text('Manga Loaded: ' + totalMangaCount);

                    // Show the load more button if auto-load is disabled
                    toggleLoadMoreButton(autoLoadMoreEnabled);

                    // Check if more results need to be loaded
                    checkAndLoadMoreResults(results.length);
                } else {
                    console.error('Search failed:', response.data);
                    alert('Search failed: ' + response.data); // Display error message
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error); // Log the error to the console
                alert('Search failed: ' + error); // Display error message
            }
        });
    }

    // Function to fetch more manga via AJAX
    function fetchMoreManga(page, query = '', type = '') {
        console.log("Fetching more manga with query:", query, "type:", type, "page:", page);
        $.ajax({
            url: madaraEnhancements.ajaxUrl,
            method: 'POST',
            data: {
                action: query || type ? 'search_manga' : 'load_more_manga',
                page: page,
                query: query,
                type: type,
                _ajax_nonce: madaraEnhancements.nonce
            },
            success: function(response) {
                console.log("Fetch more response:", response);
                if (response.success) {
                    var mangaList = response.data;
                    if (mangaList.length === 0) {
                        alert('No more manga found.');
                        return;
                    }
                    var mangaCache = JSON.parse(localStorage.getItem('mangaCache')) || [];
                    if (!Array.isArray(mangaCache)) {
                        mangaCache = [];
                    }
                    mangaCache = mangaCache.concat(mangaList); // Append the new results to the cache
                    localStorage.setItem('mangaCache', JSON.stringify(mangaCache)); // Save the updated cache in localStorage
                    totalMangaCount = mangaCache.length;
                    appendMangaTable(mangaList); // Append the new results to the table

                    // Update the manga count display
                    $('#manga-count').text('Manga Loaded: ' + totalMangaCount);

                    // Check if more results need to be loaded
                    checkAndLoadMoreResults(mangaList.length);
                } else {
                    console.error('Failed to load more manga:', response.data);
                    alert('Failed to load more manga: ' + response.data); // Display error message
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error); // Log the error to the console
                alert('Failed to load more manga: ' + error); // Display error message
            }
        });
    }

    // Function to clear the existing cache
    function clearCache() {
        $('#manga-table tbody').empty(); // Clear the table body
        localStorage.removeItem('mangaCache'); // Remove the cache from localStorage
        $('#manga-count').text('Manga Loaded: 0'); // Update the manga count display
    }

    // Function to update the manga table with new data
    function updateMangaTable(mangaList) {
        $('#manga-table tbody').empty(); // Clear the table body
        appendMangaTable(mangaList); // Append new manga data to the table
    }

    // Function to append new manga data to the table
    function appendMangaTable(mangaList) {
        var mangaTable = $('#manga-table tbody');

        // Iterate through the manga list and append rows to the table
        $.each(mangaList, function(index, manga) {
            var row = $('<tr>').appendTo(mangaTable);
            row.append($('<td>').text(totalMangaCount - mangaList.length + index + 1)); // Add the manga count as the first column
            row.append($('<td>').text(manga.title));
            row.append($('<td>').html('<img src="' + manga.cover_image + '" alt="' + manga.title + '" width="100">'));
            row.append($('<td>').text(manga.description));
            row.append($('<td>').text(manga.genres));
            row.append($('<td>').text(manga.status));
            row.append($('<td>').text(manga.last_updated));
            row.append($('<td>').text(manga.latest_chapter));
            row.append($('<td>').html('<form method="post" class="add-manga-form"><input type="hidden" name="add_manga_url" value="' + manga.url + '"><button type="submit" class="button button-primary">Add Manga</button></form>'));
        });
    }

    // Event delegation for "Add Manga" forms
    $(document).on('submit', '.add-manga-form', function(event) {
        event.preventDefault(); // Prevent the default form submission
        var form = $(this);
        var formData = form.serialize(); // Serialize the form data
        var row = form.closest('tr'); // Get the parent row of the form

        console.log("Adding manga:", formData); // Log form data for debugging

        // Add manga via AJAX
        $.ajax({
            url: madaraEnhancements.ajaxUrl,
            method: 'POST',
            data: formData + '&action=add_manga&_ajax_nonce=' + madaraEnhancements.nonce,
            success: function(response) {
                console.log("Add manga response:", response); // Log response for debugging
                if (response.success) {
                    alert('Manga added successfully!'); // Display success message
                    row.remove(); // Remove the row from the table
                    updateMangaNumbers(); // Update the manga numbers after removal

                    // Check if more results need to be loaded
                    checkAndLoadMoreResults(0); // Pass 0 since we removed one row
                } else {
                    console.error('Failed to add manga:', response.data);
                    alert('Failed to add manga: ' + response.data); // Display error message
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error); // Log the error to the console
                alert('Failed to add manga: ' + error); // Display error message
            }
        });
    });

    // Function to toggle the visibility of the "Load More" button
    function toggleLoadMoreButton(autoLoadMoreEnabled) {
        if (autoLoadMoreEnabled) {
            $('#load-more').hide();
        } else {
            $('#load-more').show();
        }
    }

    // Function to update manga numbers after a row is removed
    function updateMangaNumbers() {
        var mangaRows = $('#manga-table tbody tr').filter(function() {
            return $(this).is(':visible'); // Only count visible rows
        });
        mangaRows.each(function(index, row) {
            $(row).find('td:first').text(index + 1); // Update the number in the first column
        });
        $('#manga-count').text('Manga Loaded: ' + mangaRows.length); // Update the manga count display
    }

    // Function to check and load more results if needed
    function checkAndLoadMoreResults(resultsLength) {
        if (resultsLength < resultsThreshold && $(document).height() <= $(window).height()) {
            page++;
            localStorage.setItem('currentPage', page); // Save the current page in localStorage
            fetchMoreManga(page, currentQuery, currentType);
        }
    }
});