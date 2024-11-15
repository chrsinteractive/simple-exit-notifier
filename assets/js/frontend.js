jQuery(document).ready(function ($) {
    let externalLink = '';
    let openInNewTab = false;

    // Get the exception class from a localized variable
    const exceptionClass = simple_exit_notifier_data.exceptionClass || null; // Default to null if empty

    // Detect clicks on links
    $('a').on('click', function (e) {
        const link = $(this).attr('href');
        const hasExceptionClass = exceptionClass && $(this).hasClass(exceptionClass); // Check only if exceptionClass is set
        openInNewTab = $(this).attr('target') === '_blank'; // Check if the link should open in a new tab

        // Check if the link is external and does not have the exception class
        if (link && link.startsWith('http') && !link.includes(window.location.hostname) && !hasExceptionClass) {
            e.preventDefault(); // Prevent the default action

            // Save the external link
            externalLink = link;

            // Update the "Proceed" button with the link
            $('#simple-exit-notifier-proceed').attr('href', externalLink);

            // Show the modal
            $('#simple-exit-notifier-modal').fadeIn();
        }
    });

    // Close the modal
    $('#simple-exit-notifier-cancel').on('click', function () {
        $('#simple-exit-notifier-modal').fadeOut();
    });

    // Handle the "Proceed" button
    $('#simple-exit-notifier-proceed').on('click', function (e) {
        e.preventDefault(); // Prevent default button action

        // Open the link in the appropriate way
        if (openInNewTab) {
            window.open(externalLink, '_blank'); // Open in a new tab
        } else {
            window.location.href = externalLink; // Open in the same tab
        }

        // Close the modal (optional)
        $('#simple-exit-notifier-modal').fadeOut();
    });
});
