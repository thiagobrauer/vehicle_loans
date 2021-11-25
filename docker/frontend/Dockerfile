FROM node:16.13.0-alpine3.13

WORKDIR /var/www/frontend

COPY ./frontend/package.json ./

RUN npm install

COPY . .

CMD npm run serve