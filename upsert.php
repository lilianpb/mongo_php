<?php

$bulk = new MongoDB\Driver\BulkWrite();
$bulk->delete([]);
$bulk->insert(['_id' => 1, 'name' => 'kity', 'age' => '3']);
$bulk->insert(['_id' => 2, 'name' => 'kity', 'age' => '3']);


$bulk->update(['name' => 'kity'], ['$set' => ['age' => '5']], ['multi' => false, 'upsert' => true]);


/*
$bulk->insert(['_id' => 1, 'x' => 1]);
$bulk->insert(['_id' => 2, 'x' => 2]);

$bulk->update(['x' => 2], ['$set' => ['x' => 1]], ['multi' => false, 'upsert' => false]);
$bulk->update(['x' => 3], ['$set' => ['x' => 3]], ['multi' => false, 'upsert' => true]);
$bulk->update(['_id' => 3], ['$set' => ['x' => 3]], ['multi' => false, 'upsert' => true]);

$bulk->insert(['_id' => 4, 'x' => 2]);

$bulk->delete(['x' => 1], ['limit' => 1]);
*/

$manager = new MongoDB\Driver\Manager('mongodb://root:example@mongo-db:27017');
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
$result = $manager->executeBulkWrite('animals.gatitos', $bulk, $writeConcern);

printf("Inserted %d document(s)\n", $result->getInsertedCount());
printf("Matched  %d document(s)\n", $result->getMatchedCount());
printf("Updated  %d document(s)\n", $result->getModifiedCount());
printf("Upserted %d document(s)\n", $result->getUpsertedCount());
printf("Deleted  %d document(s)\n", $result->getDeletedCount());

foreach ($result->getUpsertedIds() as $index => $id) {
    printf('upsertedId[%d]: ', $index);
    var_dump($id);
}

/* If the WriteConcern could not be fulfilled */
if ($writeConcernError = $result->getWriteConcernError()) {
    printf("%s (%d): %s\n", $writeConcernError->getMessage(), $writeConcernError->getCode(), var_export($writeConcernError->getInfo(), true));
}

/* If a write could not happen at all */
foreach ($result->getWriteErrors() as $writeError) {
    printf("Operation#%d: %s (%d)\n", $writeError->getIndex(), $writeError->getMessage(), $writeError->getCode());
}
?>