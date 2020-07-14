FROM alpine:3.12 AS kafka-builder

LABEL maintainer="Plamen Petrov <plamen.milchev.petrov@gmail.com>"

ENV KAFKA_VERSION 2.5.0
ENV SCALA_VERSION 2.13

RUN apk --no-cache add openjdk11 docker coreutils su-exec
RUN apk add --no-cache -t .build-deps curl ca-certificates jq \
  && mkdir -p /opt \
  && mirror=$(curl --stderr /dev/null https://www.apache.org/dyn/closer.cgi\?as_json\=1 | jq -r '.preferred') \
  && curl -sSL "${mirror}kafka/${KAFKA_VERSION}/kafka_${SCALA_VERSION}-${KAFKA_VERSION}.tgz" \
  | tar -xzf - -C /opt \
  && mv /opt/kafka_${SCALA_VERSION}-${KAFKA_VERSION} /opt/kafka

FROM debian:stretch AS kafka

RUN addgroup --system supervisor

RUN apt-get update \
    && apt-get -y dist-upgrade \
    && apt-get install -y supervisor curl jq

COPY docker/bin /usr/local/bin/
RUN chmod +x /usr/local/bin/supervisord

COPY docker/kafka/supervisor/* /etc/supervisor/conf.d/
COPY --from=kafka-builder /opt/kafka /opt/kafka

# Install OpenJDK-8
RUN apt-get update \
    && apt-get install -y openjdk-8-jdk \
    && apt-get install -y ant \
    && apt-get clean;

# Fix certificate issues
RUN apt-get update \
    && apt-get install ca-certificates-java \
    && apt-get clean \
    && update-ca-certificates -f;

WORKDIR /opt/kafka

CMD ["/usr/local/bin/supervisord"]