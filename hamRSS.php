<?php
/**
 * Plugin hamRSS
 *
 * @version        1.0
 * @date        10/11/2013
 * @author        Damien Guillot
 **/
class hamRSS extends plxPlugin {

        /**
         * Constructeur de la classe
         *
         * @param        default_lang        langue par défaut
         * @return        stdio
         * @author        Stephane F
         **/
        public function __construct($default_lang) {

        # appel du constructeur de la classe plxPlugin (obligatoire)
        parent::__construct($default_lang);

                # droits pour accèder à la page config.php du plugin
                $this->setConfigProfil(PROFIL_ADMIN);

        # déclaration des hooks
				$this->addHook('FeedBegin', 'Redirect307');
    }

        /**
         * Méthode qui redirige la page feed.php vers le service
         *
         * @return        stdio
         * @author        Damien Guillot
         **/
		public function Redirect307() {
			if($this->getParam('activate') == 'ok') {
				// Do nothing if FeedPress is the user-agent
				if (preg_match('/FeedPress/i', $_SERVER['HTTP_USER_AGENT'])) return;
				
				// Do nothing if FeedBurner is the user-agent
				if (preg_match('/feedburner/i', $_SERVER['HTTP_USER_AGENT'])) return;

			    // Do nothing if feedvalidator is the user-agent
			    if (preg_match('/feedvalidator/i', $_SERVER['HTTP_USER_AGENT'])) return;

				// Avoid redirecting Googlebot to avoid sitemap feeds issues
				if (preg_match('/googlebot/i', $_SERVER['HTTP_USER_AGENT'])) return;
				
				if (($_SERVER["REQUEST_URI"] == '/feed/rss') OR ($_SERVER["REQUEST_URI"] == '/feed.php?rss')) {
					header("Status: 307 Temporary Redirect", false, 307);
			    	header('Location: '.$this->getParam('RSSurl').'');
			    	exit();
				};
			}

		}

}
?>