# Kafka

### Producer/Consumer API
To bootstrap project run the following docker-compose command.  

```docker-compose -f docker-compose.kafka-producer.yml -f docker-compose.kafka-consumer.yml -f docker-compose.kafka-zookeeper.yml up```

After all containers are up you have to run composer install command in kafka-producer container to finish laravel project setup:

```docker exec -it kafka-producer bash```
```composer install```

Copy the .env.example file ( cp .env.example .env ) in kafka-zookeeper and kafka-producer folders.

To produce a message access `http://localhost` in your browser. This endpoint will produce new static message in kafka topic com.kafka.demo.

To visualise details about kafka broker, topics, messages, partitions etc. you can use a web based UI accessed at `http://localhost:9091` in your browser.
