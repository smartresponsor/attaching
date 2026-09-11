# CMCP Orchestration Journal

## 2026-09-11 — Iteration 1/5: reconnaissance and baseline

### Scope and repository state
- Target/write boundary: `Attaching` only (`D:\PhpstormProjects\www\attaching`).
- Branch: `refactor/canonical-attachment-tree-v2`.
- Pre-existing worktree state: untracked `.gating/`; it is not modified by this iteration.
- Package identity: `attaching/attachment`; runtime namespace is `App\Attaching\` under `src/`.
- Current production dependency declared by Attaching: `objecting/object` via local symlink path repository `../Objecting`.
- Mandatory application contour was inspected through the local `Objecting`, `Cruding`, `Viewing`, and `Interfacing` package contracts. Attaching currently declares only Objecting; no production PHP imports of Cruding, Viewing, or Interfacing were found during the initial dependency scan, so adding those packages is deferred until an actual runtime contract is identified rather than inventing coupling.

### Material read surface
- Target: `AGENTS.md`, `README.md`, `composer.json`, `CHANGELOG.md`, `docs/release/release-process.adoc`, `docs/antora.yml`, principal attachment entities, QA configuration, and current source/test topology.
- Objecting: `README.md`, `composer.json`, `ObjectStateEmbeddableTrait`, `ObjectStateEmbeddable`, `ObjectTitleEmbeddableTrait`, and `ObjectTitleEmbeddable`.
- Cruding, Viewing, Interfacing: each repository `README.md` and `composer.json` responsibility/package contracts.
- Canonization: root `README.md`, architecture canon README, and normative rules `Canon004`, `Canon005`, `Canon007`, `Canon008`, `Canon010`, `Canon017`, `Canon018`, and `Canon019`.
- Gating: root `README.md` and `composer.json`; Gating is treated as executable enforcement, not the normative source.

### Canon mapping
- `Canon004` subject-folder placement: Attaching is role-first overall, but current `src/**/Attachment/` folders require later targeted review because early subject folders are prohibited outside the Entity exception unless the depth/context is justified.
- `Canon005` meaningful namespace tokens: retain technical-role families only when each token predicts responsibility; avoid ceremonial `Attachment` repetition.
- `Canon007` literal PSR-4 identity: current `App\Attaching\ => src/` mapping is the migration invariant for any later tree edits.
- `Canon008` dependency integrity: Objecting usage is backed by `objecting/object`. No Cruding/Viewing/Interfacing namespace usage was found in the first production import scan; do not add undeclared runtime imports or speculative dependencies.
- `Canon010` migration completeness: any later topology or field migration must update code, tests, Symfony config/routes, fixtures, docs, and metadata together.
- `Canon017` docs/runtime parity: README currently says persistence is under `src/Entity/`, while the runtime entity lives under `src/Entity/Persistence/Attachment/`; documentation must be reconciled when the canonical target is finalized.
- `Canon018` Composer identity mapping: `attaching/attachment` correctly maps component `Attaching` to namespace `App\Attaching\`; subject vocabulary is `Attachment*` for component-owned PHP types.
- `Canon019` no alternative layer taxonomy: no `src/Domain`, `Application`, `Infrastructure`, `Port`, `Adapter`, or `Adaptor` root is to be introduced.

### Market / maturity opening mixin
- Baseline attachment/media products expect association/linking, validation, metadata, multiple storage backends, lifecycle-safe deletion, and reliable downloads.
- Mature growth capabilities commonly include derivative/conversion pipelines, responsive media, richer collection metadata, async processing, and multi-filesystem backends.
- Those capabilities are post-RC growth for Attaching unless required for correctness or operability; they must not broaden the current component boundary.

### RC-critical workstream selected
Restore Doctrine mapping correctness for `Attachment` after Objecting adoption, then verify the complete affected runtime path. PHPUnit currently reports 10 integration errors with one root cause: duplicate Doctrine column `status` on `App\Attaching\Entity\Persistence\Attachment\Attachment`.

Initial evidence shows the collision is factual: Attaching maps a local enum property as column `status`, while Objecting's `ObjectStateEmbeddable` also maps `objectStatus` to the physical column `status` through `ObjectStateEmbeddableTrait` with `columnPrefix: false`. The fix must preserve one authoritative current model and Objecting's system-field ownership rather than hiding the collision.

### Growth workstream (non-blocking for RC)
- Storage-driver expansion beyond the local baseline.
- Media derivatives/conversions and responsive variants.
- Async post-upload processing and richer metadata/collection policy.
- UX/API capability growth only after the correctness and architecture gates are green.

### Baseline gates
- `composer validate --strict`: PASS.
- `composer phpstan`: PASS (`No errors`).
- `composer test`: FAIL (10 integration errors; duplicate Doctrine column `status`).
- `composer cs:check`: PASS (0 of 92 files require fixes).
- Doctrine mapping/runtime verification: pending after repair.
- Canon/Gating checks: inspect/apply available target-local executable policy after the mapping blocker is repaired; do not modify the pre-existing untracked `.gating/` without explicit need.

### Risks / constraints
- Objecting owns system-field packs; a local clone or second system-status column would recreate the duplication the platform canon is removing.
- The local business `AttachmentStatus` enum may still be valuable as domain vocabulary, but its persistence mapping must not collide with canonical Objecting state storage.
- Tree canonization must not be mixed blindly into the mapping repair; topology changes require complete caller/config/test/docs synchronization.
- Writes remain confined to Attaching. Canonization, Gating, Objecting, Cruding, Viewing, and Interfacing are read-only references for this task.

### Next bounded step
Iteration 2: implement the smallest coherent Attaching-only mapping repair that removes the `status` collision while retaining the intended attachment lifecycle API, update directly affected tests/docs if required, and run PHPUnit plus static/style checks on the resulting state.

Что имеем? Фактический RC-блокер локализован до конфликта local `status` и Objecting `object_state.status`; package identity and PHPStan baseline зелёные.

Что осталось? Материально исправить mapping в iteration 2, проверить Doctrine/runtime behavior и закрыть оставшиеся canon/documentation tails перед integration/acceptance.

## 2026-09-11 — Iteration 2/5: material implementation

### Implemented repair
+- Removed the duplicate local Doctrine-mapped `Attachment::$status` property.
+- Preserved the public `AttachmentStatus` lifecycle API by deriving `getStatus()` from Objecting's canonical `object_state.status` value.
+- `markDeleted()` and `restore()` now mutate only the Objecting state pack for lifecycle status, avoiding parallel persistence state.
+- Updated Doctrine repository predicates to query `objectState.objectStatus` and bind scalar enum values because Objecting persists that field as a string.
+
+### Verification
+- Changed-file PHP lint: PASS (3/3 PHP files).
+- `composer test`: PASS — 30 tests, 221 assertions.
+- `composer phpstan`: PASS — no errors.
+- `composer cs:check`: PASS — 0 of 92 files require fixes.
+- `doctrine:schema:validate --env=test`: mapping PASS; local test database schema reports out-of-sync. No destructive schema reset/update was performed because destructive operations are forbidden by the task capability envelope. The passing integration suite rebuilds/uses its controlled test schema path and validates the repaired mapping behavior.
+
+### Resulting invariant
+`ObjectStateEmbeddable` is the single persisted owner of attachment lifecycle status. `AttachmentStatus` remains Attaching-owned business vocabulary exposed by the entity API, not a second Doctrine column.
+
+Что имеем? Исходный duplicate-column fail устранён; runtime integration tests, static analysis, syntax and style gates are green.
+
+Что осталось? Commit this coherent repair, then iteration 3 should inspect the resulting state for schema/migration and canon/documentation tails, including stale prefixed Objecting column references, without modifying sibling repositories.

## 2026-09-11 — Iteration 3/5: verification and fix

### Verification findings
- Read-only RC diagnostic reports `rc_diagnostic_green` with zero canon issues for the current runtime tree.
- Manual executable-surface review found a false-green tail in `app:attachment:migrate-identifiers`: the PostgreSQL rebuild path still emitted legacy `object_*` Objecting columns and both `status` plus `object_status`.
- Historical Doctrine migration files still document the earlier transition shape. They were not rewritten in this iteration because they are irreversible migration history; the active maintenance command is the executable path that could recreate the stale schema and therefore required correction.

### Implemented fix
- Updated `MigrateAttachmentIdentifiersCommand` to recreate current Objecting physical columns: `uuid`, `slug`, title fields, audit fields, `active`, `enabled`, and canonical `status`.
- Removed duplicate `object_status` persistence from the rebuild SQL and aligned `status` length to Objecting's 64-character mapping.
- Updated attachment-link audit columns in the same rebuild path to current unprefixed Objecting names.
- Added a regression assertion in `AttachmentTreeLayerTest` preventing reintroduction of key `object_*` columns in the executable identifier migration.
- Updated README persistence-path wording to the actual `src/Entity/Persistence/Attachment/` location.

### Verification
- Changed-file PHP lint: PASS (2/2 PHP files).
- `composer validate --strict`: PASS.
- `composer test`: PASS — 31 tests, 228 assertions.
- `composer phpstan`: PASS — no errors.
- `composer cs:check`: PASS — 0 of 92 files require fixes.
- RC diagnostic: GREEN, zero canon issues.

Что имеем? Runtime и destructive maintenance path теперь описывают одну и ту же текущую Objecting physical schema; README также синхронизирован с runtime tree.

Что осталось? Создать отдельный coherent iteration-3 commit; iteration 4 затем закрывает integration/release tails и Git publication posture.

## 2026-09-11 — Iteration 4/5: debt closure and integration

### Integration findings
- Branch `refactor/canonical-attachment-tree-v2` tracks `origin/refactor/canonical-attachment-tree-v2`, is ahead by two commits and behind by zero.
- RC validation is green: Composer validation, PHPStan, PHPUnit, and canon checks passed with zero blockers.
- CI and release documentation use the same PHP 8.4 quality contour as local verification.
- `composer audit` exposed a previously uncovered RC blocker: 12 security advisories across 6 locked dependencies, including high-severity Symfony MIME and Security HTTP advisories.

### Debt closure selected
- Refresh the affected Symfony dependency locks within existing package constraints.
- Re-run Composer audit and all local quality gates.
- Update `CHANGELOG.md` with the lifecycle mapping, identifier-migration schema, and dependency-security fixes.

Что имеем? Functional/canon integration is green, but dependency security is a real RC blocker and is being closed in this iteration.

Что осталось? Complete the scoped Composer refresh, require a green audit and full gate set, then commit the release/security closure.

### Security remediation result
- Updated affected Symfony packages and required transitive dependencies to patched releases within existing constraints; the lock now includes current Symfony 8.1 security-fixed versions.
- Removed unintended `objecting/object` dev-master lock drift introduced by the first dependency resolution so this Attaching task does not silently advance a sibling component revision.
- `composer audit`: PASS — no security vulnerability advisories found.
- `composer validate --strict`: PASS.
- `composer test`: PASS — 31 tests, 228 assertions.
- `composer phpstan`: PASS — no errors.
- `composer cs:check`: PASS — 0 of 92 files require fixes.

Что имеем? Functional, canon, dependency-security and release-documentation contours are green; branch remains integration-ready with only the pre-existing untracked `.gating/` outside this task's owned changes.

Что осталось? Commit this debt-closure batch. Iteration 5 should perform final acceptance/release review and decide publication/push according to the original Git policy.

## 2026-09-11 — Iteration 5/5: final acceptance and publication

### Final acceptance
- Bounded RC validation is green: Composer validation, PHPStan, PHPUnit, and canon checks pass with zero blockers or warnings.
- Dependency security remains green after remediation: the previous iteration's Composer audit reported no advisories.
- Branch `refactor/canonical-attachment-tree-v2` is ahead of its configured upstream and behind by zero; the only dirty item is the pre-existing untracked `.gating/`, which is not part of this task's owned changes.
- Existing PR #3 targets `master` from this branch and is mergeable at the Git level. Its historical GitHub Actions checks are failed, so remote merge must remain subject to the repository merge gate after the updated branch is pushed.
- The full RC wrapper timed out once during final acceptance, but the bounded RC validator completed successfully and reproduces the required local validation contour.

### Terminal state
No further Attaching code, schema, documentation, dependency-security, or canon blockers were found within the execution budget. The task is ready for branch publication and PR re-evaluation.

Что имеем? Пять итераций materially completed; all owned changes are committed and local acceptance is green.

Что осталось? Push the current branch, inspect PR #3 against the new head, and merge only if the safe merge gate permits it.
