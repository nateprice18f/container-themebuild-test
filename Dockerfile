FROM node:19.9-bullseye-slim AS theme-builder

ARG BUID=1000
ARG BGID=1000


RUN sed -E -i "s/:x:${BUID}:/:x:1919:/g" /etc/passwd \
    && sed -E -i "s/:x:([0-9]+):${BGID}:/:x:\1:1919:/g" /etc/passwd \
    && sed -E -i "s/:x:${BGID}:/:x:1919:/g" /etc/group \
    && sed -E -i "s/node:x:[0-9]+:[0-9]+:/node:x:${BUID}:${BGID}:/g" /etc/passwd \
    && sed -E -i "s/node:x:[0-9]+:/node:x:${BGID}:/g" /etc/group

RUN npm install --global \
      gulp \
    && chown -R node:node /home/node/

#COPY --chown=node:node web/themes/custom/ /var/www/web/themes/custom/
#COPY --chown=node:node web/libraries/ /var/www/web/libraries/
ADD --chown=node:node ./compose/web/themes /var/www/web/themes/
ADD --chown=node:node compose/web/themes /var/www/web/themes/
ADD --chown=node:node /compose/web/themes /var/www/web/themes/
#COPY --chown=node:node ./compose/web/libraries/ /var/www/web/libraries/

WORKDIR /var/www/web/themes/custom/usagov

RUN chown -R node:node /var/www/web/themes \
    && chown -R node:node /home/node/

USER node

RUN npm install --production=false --prefix /var/www/web/themes/custom/usagov \
    && npm rebuild node-sass --prefix /var/www/web/themes/custom/usagov \
    && npm run build --prefix /var/www/web/themes/custom/usagov \
    && chown -R node:node /var/www/web/themes
