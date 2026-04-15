name: Deploy to Kinsta

on:
push:
branches: - main - staging

jobs:
deploy-staging:
if: github.ref == 'refs/heads/staging'
runs-on: ubuntu-latest
steps: - name: Checkout code
uses: actions/checkout@v3

      - name: Setup SSH
        run: |
          mkdir -p ~/.ssh
          echo "${{ secrets.KINSTA_SSH_KEY }}" > ~/.ssh/deploy_key
          chmod 600 ~/.ssh/deploy_key
          ssh-keyscan -p ${{ secrets.KINSTA_STAGING_PORT }} ${{ secrets.KINSTA_HOST }} >> ~/.ssh/known_hosts

      - name: Deploy to Staging
        run: |
          rsync -avzr --delete \
            --exclude='uploads/' \
            --exclude='cache/' \
            --exclude='autoptimize/' \
            --exclude='.git' \
            -e "ssh -i ~/.ssh/deploy_key -p ${{ secrets.KINSTA_STAGING_PORT }} -o StrictHostKeyChecking=no" \
            ./wp-content/ \
            ${{ secrets.KINSTA_USER }}@${{ secrets.KINSTA_HOST }}:/www/mytestsitem_146/public/wp-content/

      # - name: Post-Deployment Commands (Activate Plugins & Clear Cache)
      #   run: |
      #     ssh -i ~/.ssh/deploy_key -p ${{ secrets.KINSTA_STAGING_PORT }} ${{ secrets.KINSTA_USER }}@${{ secrets.KINSTA_HOST }} << 'EOF'
      #       cd /www/mytestsitem_146/public
      #       wp plugin activate --all --quiet
      #       wp cache flush
      #       wp acf sync # Optional: Force ACF to look for new JSON files
      #     EOF
      # - name: Post-Deployment Commands (Safety Mode)
      #   run: |
      #     ssh -i ~/.ssh/deploy_key -p ${{ secrets.KINSTA_STAGING_PORT }} ${{ secrets.KINSTA_USER }}@${{ secrets.KINSTA_HOST }} << 'EOF'
      #       cd /www/mytestsitem_146/public

      #       # 1. Flush cache while IGNORING the broken plugins
      #       wp cache flush --skip-plugins --skip-themes

      #       # 2. Deactivate the specific plugin causing the crash
      #       wp plugin deactivate better-wp-security --skip-plugins --skip-themes

      #       # 3. Now activate everything else
      #       wp plugin activate --all --quiet

      #       # 4. Final cache flush now that things are stable
      #       wp cache flush
      #     EOF
      - name: Post-Deployment Commands (Safety Mode)
        run: |
          ssh -i ~/.ssh/deploy_key -p ${{ secrets.KINSTA_STAGING_PORT }} -o StrictHostKeyChecking=no ${{ secrets.KINSTA_USER }}@${{ secrets.KINSTA_HOST }} << 'EOF'
            cd /www/mytestsitem_146/public

            # 1. Flush cache while IGNORING the broken plugins to bypass the Fatal Error
            wp cache flush --skip-plugins --skip-themes

            # 2. Deactivate the specific plugin causing the crash
            wp plugin deactivate better-wp-security --skip-plugins --skip-themes

            # 3. Now activate everything else
            wp plugin activate --all --quiet

            # 4. Final cache flush now that things are stable
            wp cache flush
          EOF

deploy-live:
if: github.ref == 'refs/heads/main'
runs-on: ubuntu-latest
steps: - name: Checkout code
uses: actions/checkout@v3

      - name: Setup SSH
        run: |
          mkdir -p ~/.ssh
          echo "${{ secrets.KINSTA_SSH_KEY }}" > ~/.ssh/deploy_key
          chmod 600 ~/.ssh/deploy_key
          ssh-keyscan -p ${{ secrets.KINSTA_PORT }} ${{ secrets.KINSTA_HOST }} >> ~/.ssh/known_hosts

      - name: Deploy to Live
        run: |
          rsync -avzr --delete \
            --exclude='uploads/' \
            --exclude='cache/' \
            --exclude='autoptimize/' \
            --exclude='.git' \
            -e "ssh -i ~/.ssh/deploy_key -p ${{ secrets.KINSTA_PORT }} -o StrictHostKeyChecking=no" \
            ./wp-content/ \
            ${{ secrets.KINSTA_USER }}@${{ secrets.KINSTA_HOST }}:/www/mytestsitem_146/public/wp-content/

      # - name: Post-Deployment Commands (Activate Plugins & Clear Cache)
      #   run: |
      #     ssh -i ~/.ssh/deploy_key -p ${{ secrets.KINSTA_PORT }} ${{ secrets.KINSTA_USER }}@${{ secrets.KINSTA_HOST }} << 'EOF'
      #       cd /www/mytestsitem_146/public
      #       wp plugin activate --all --quiet
      #       wp cache flush
      #     EOF
      # - name: Post-Deployment Commands (Safety Mode)
      #   run: |
      #     ssh -i ~/.ssh/deploy_key -p ${{ secrets.KINSTA_STAGING_PORT }} ${{ secrets.KINSTA_USER }}@${{ secrets.KINSTA_HOST }} << 'EOF'
      #       cd /www/mytestsitem_146/public

      #       # 1. Flush cache while IGNORING the broken plugins
      #       wp cache flush --skip-plugins --skip-themes

      #       # 2. Deactivate the specific plugin causing the crash
      #       wp plugin deactivate better-wp-security --skip-plugins --skip-themes

      #       # 3. Now activate everything else
      #       wp plugin activate --all --quiet

      #       # 4. Final cache flush now that things are stable
      #       wp cache flush
      #     EOF
      - name: Post-Deployment Commands (Safety Mode)
        run: |
          ssh -i ~/.ssh/deploy_key -p ${{ secrets.KINSTA_PORT }} -o StrictHostKeyChecking=no ${{ secrets.KINSTA_USER }}@${{ secrets.KINSTA_HOST }} << 'EOF'
            cd /www/mytestsitem_146/public

            # 1. Flush cache while IGNORING the broken plugins to bypass the Fatal Error
            wp cache flush --skip-plugins --skip-themes

            # 3. Now activate everything else
            wp plugin activate --all --quiet

            # 4. Final cache flush now that things are stable
            wp cache flush
          EOF

####

# --- WORDPRESS CORE ---

# We don't track core because Kinsta manages updates.

wp-admin/
wp-includes/
wp-\*.php
xmlrpc.php
license.txt
readme.html
nginx.conf

# Ignore the index.php in the root folder

/index.php

# Ignore all other index.php files everywhere else by default

\*\*/index.php

# Now, EXCEPTION: Allow the index.php inside your specific theme

!wp-content/themes/prodoscore_theme/index.php

# --- CONFIG & SECRETS ---

# Never track passwords.

wp-config.php
wp-config-sample.php
.env

# --- THE PLUGINS (CRITICAL CHANGE) ---

# We REMOVE the ignore for plugins so they sync via Git.

# However, we ignore specific heavy/junk plugin data.

wp-content/plugins/akismet/
wp-content/plugins/hello.php

# --- UPLOADS & STATE (THE "DOWN" FLOW) ---

# We never push these UP; we only pull them DOWN via DevKinsta.

wp-content/uploads/
wp-content/blogs.dir/
wp-content/upgrade/
wp-content/backup-db/
wp-content/advanced-cache.php
wp-content/wp-cache-config.php

# --- CACHE & PERFORMANCE ---

# Don't track generated files from WP Super Cache or Autoptimize.

wp-content/cache/
wp-content/autoptimize/

# --- THEMES ---

# We track our custom theme, but we ignore the default WP themes.

wp-content/themes/twentytwenty\*/
wp-content/themes/twentytwentyone/
wp-content/themes/twentytwentytwo/
wp-content/themes/twentytwentythree/

# --- OS & TOOLS ---

.DS_Store
Thumbs.db
node_modules/
.parcel-cache
dist/
npm-debug.log\*
