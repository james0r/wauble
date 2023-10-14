# sudo docker build --no-cache --network host -t james0r/nginx .
# sudo docker push james0r/nginx

FROM bitnami/nginx:1.17.10-debian-10-r71

# Install Node 18
USER root
RUN set -uex \
  && apt-get update \
  && apt-get install -y ca-certificates curl gnupg \
  && mkdir -p /etc/apt/keyrings \
  && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
  && NODE_MAJOR=18 && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
  && apt-get update \
  && mkdir /tmp/npm_cache && export npm_config_cache=/tmp/npm_cache \
  && apt-get install nodejs -y
USER 1001