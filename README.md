

To build assets for api platform:
cd <GIT_PROJECT_DIR>
docker run --rm -it -v $PWD/app:/usr/src/app node bash
cd usr/src/app/
yarn build