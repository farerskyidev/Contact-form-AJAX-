<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="/sass/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,700;1,700&family=Overpass:ital,wght@0,600;1,600&family=Hind:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="header">
        <div class="form">
            <h1>Reach Out and <span>Connect</span> With Us</h1>
            <h5>Bridging Your Ideas with Our Expertise</h5>
            <form id="my-form">
                <div class="part-form">
                    <input class="field-input" type="text" id="name" name="name" placeholder="Name *" required>
                    <div id="nameError" class="error-message" style="display: none;">enter correct value
                    </div>
                </div>
                <div class="part-form">
                    <input class="field-input" type="email" id="email" name="email" placeholder="E-mail *" required>
                    <div id="emailError" class="error-message" style="display: none;">enter correct value</div>
                </div>
                <div class="part-form">
                    <input class="field-input" type="tel" id="phone" name="phone" placeholder="Phone *" pattern="^\+?[0-9]{1,3}\s?[0-9]{3}\s?[0-9]{3}\s?[0-9]{4}$" required>
                    <div id="phoneError" class="error-message" style="display: none;">enter correct value</div>
                </div>
                <div class="part-form">
                    <input class="field-input" type="password" id="password" name="Password " placeholder="Password *" required>
                    <a href="#" class="password-control"></a>
                </div>
                <div class="part-form select">
                    <select id="city" name="city" required>
                        <option value="">Choise your city *</option>
                        <option value="Київ">Київ</option>
                        <option value="Харків">Харків</option>
                        <option value="Одеса">Одеса</option>
                    </select>
                </div>
                <div class="part-form part-form-last">
                    <label class="privacy_policy">
                        <input type="checkbox" id="privacy_policy" name="privacy_policy" class="custom-checkbox" required>
                        <span class="checkbox-image"></span>
                        I have read and accepted  <a href="#"> privacy policy</a>
                    </label>
                    <input class="submit" type="submit" value="Submit">
                </div>
            </form>
        </div>
        <div id="response"></div>
    </header>
    <script>
        $('#city').select2();
    </script>


