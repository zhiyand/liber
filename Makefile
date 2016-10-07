tags:
	ctags -R .

copy:
	rsync -avz \
		--exclude '.git/*'\
		--exclude 'node_modules/'\
		--exclude 'storage/'\
		--exclude 'resources/assets/'\
		--exclude 'tests/'\
		--exclude 'tags'\
		./\
		zhiyan:/var/www/zhiyan.de/liber
	ssh zhiyan\
		'cp ~/.env.liber /var/www/zhiyan.de/liber/.env && chown www-data.www-data /var/www/zhiyan.de/liber -R'

cs:
	php-cs-fixer fix
