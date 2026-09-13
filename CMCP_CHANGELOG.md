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
- Branch `refactor/canonical-attachment-tree-v2` is ahead of its configured upstream and behind by zero. The pre-existing local `.gating/` execution-policy copy is now explicitly ignored via `/.gating/` so it cannot be accidentally staged and no longer leaves the repository permanently dirty.
- Existing PR #3 targets `master` from this branch and is mergeable at the Git level. Its historical GitHub Actions checks are failed, so remote merge must remain subject to the repository merge gate after the updated branch is pushed.
- The full RC wrapper timed out once during final acceptance, but the bounded RC validator completed successfully and reproduces the required local validation contour.

### Terminal state
No further Attaching code, schema, documentation, dependency-security, or canon blockers were found within the execution budget. The task is ready for branch publication and PR re-evaluation.

Что имеем? Пять итераций materially completed; all owned changes are committed and local acceptance is green.

Что осталось? Push the current branch, inspect PR #3 against the new head, and merge only if the safe merge gate permits it.

## 2026-09-13 — Iteration 1/5: reconnaissance and canonical baseline

### Scope and repository state
- Write boundary remains `Attaching` only (`D:\PhpstormProjects\www\attaching`); sibling repositories are read-only contract sources.
- Branch at baseline: `refactor/canonical-attachment-tree-v2`; worktree was clean before this run.
- The previous 2026-09-11 RC wave is preserved as historical evidence but was not assumed current without verification.
- Current repository is a dual-mode Symfony component because it exposes `bin/console`, `config/bundles.php`, and `App\Attaching\AttachingBundle`.

### Material read surface
- Attaching: `AGENTS.md`, `README.md`, `composer.json`, prior `CMCP_CHANGELOG.md`, standalone bundle/configuration surfaces, component service/route exports, PHPUnit/PHPStan/PHP-CS-Fixer configuration, CI, release and integration documentation, and RC inventory/diagnostic output.
- Canonization: normative architecture rules Canon004, Canon005, Canon007, Canon008, Canon010, Canon017, Canon018, Canon019, Canon020, Canon021, Canon022, Canon023, Canon024, Canon025, Canon026, Canon029, Canon030, Canon031, Canon032, Canon033, Canon037, Canon039, and Canon040 plus the architecture guard matrix.
- Gating: repository responsibility and package contract; treated as executable enforcement companion rather than the normative source.
- Runtime dependency contour: Objecting, Cruding, Collectioning, Tabling, Viewing, and Interfacing package identities, responsibilities, bundle surfaces, and current Composer contracts were inspected. Objecting system-field ownership remains authoritative for lifecycle/system fields.
- A bounded RC diagnostic reported green with zero canon findings, but direct comparison with current textual Canonization revealed missing hard requirements; this run therefore treats that diagnostic as incomplete rather than authoritative.

### Target-to-canon mapping
- Canon004/005/007/018/019/020: retain role-first `App\Attaching\` topology and literal PSR-4 identity; do not introduce alternative layer taxonomies or ceremonial subject folders.
- Canon008/022: standalone Attaching must declare direct runtime dependencies on `cruding/crud`, `collectioning/collection`, `tabling/table`, `viewing/view`, `interfacing/interface`, `objecting/object`, and `easycorp/easyadmin-bundle`.
- Canon021: attachment-specific upload/download/attach/detach operations stay component-owned; no generic CRUD engine is to be introduced locally.
- Canon023: development SmartResponsor dependencies use sibling Composer path repositories with `symlink: true`.
- Canon024/033: add a path-independent `composer.prod.json` that preserves package/type/PSR-4/PHP/Symfony identity parity with development.
- Canon025/032: preserve both standalone and reusable-bundle execution; verify standalone bundle registration after dependency wiring changes.
- Canon026: raise the Symfony platform floor from `^8.0` to `^8.1` while keeping PHP `^8.4`.
- Canon029/039/040: existing PHPStan, PHP-CS-Fixer and PHPUnit surfaces are present; coverage execution/evidence requires explicit closure because the current Composer scripts expose no persistent branch-coverage summary.
- Canon030: because Attaching owns Doctrine entities and migrations, an executable isolated schema-parity contract is required; current scripts do not yet expose one.
- Canon037: tracked `config/reference.php` is prohibited generated source and must be untracked/ignored rather than maintained as authoritative configuration.
- Canon010/017: all package/config/test/docs surfaces changed by this migration must remain synchronized.

### Market / maturity opening mixin
- Mature attachment systems baseline secure server-side validation, content-aware MIME handling, storage outside the public webroot or on a separate storage host, lifecycle-safe deletion, and reliable download authorization.
- Advanced enterprise maturity commonly adds object storage, pre-signed/direct upload paths, malware/quarantine scanning, asynchronous processing, derivatives/conversions, and richer metadata/collection policies.
- These advanced capabilities remain a separate growth track and do not block this RC unless a concrete current correctness or safety defect requires them.

### RC-critical workstream selected
Close the current Canonization packaging/runtime-contract drift without changing Attaching business responsibility: align development and production Composer manifests, direct platform dependencies, Symfony 8.1 baseline, standalone bundle/runtime registration, generated-artifact policy, test tooling evidence, and Doctrine schema-parity execution. Then run the complete affected validation surface.

### Growth workstream (non-blocking for RC)
- Flysystem/object-storage driver support and provider-neutral storage configuration.
- Direct/pre-signed uploads where appropriate.
- Malware scanning/quarantine and asynchronous post-upload processing.
- Derivatives/conversions, richer metadata, and UX/API improvements after the canonical RC baseline is green.

### Risks and safeguards
- Do not modify dirty sibling worktrees such as Objecting; only consume their published/local package contracts.
- Avoid dependency lock drift beyond the explicitly required baseline packages and Symfony 8.1 contour.
- Do not register helper bundles speculatively; registration must follow actual standalone runtime needs and bundle contracts.
- Generated artifacts are removed from tracking only after confirming Canon037 and ignore coverage.

### Material implementation started
- `composer.json` now declares the current Canon022 baseline packages directly, raises Symfony constraints to `^8.1`, uses local path/symlink repositories for the six SmartResponsor sibling dependencies, and enables development stability needed for local branch packages.

### Gates planned
- Composer validation and dependency resolution/audit.
- PHP syntax, PHPStan, PHPUnit and CS check.
- Symfony container/YAML/runtime boot validation.
- Doctrine mapping and isolated schema/migration parity where the repository can execute it safely.
- Current textual Canonization/Gating review plus final bounded RC validation.

Что имеем? Current textual canon has been mapped explicitly and the first package-contract repair is already materialized in the development manifest; the earlier green RC diagnostic is known to be false-green for newly materialized canon rules.

Что осталось? Complete the production manifest, runtime/bundle and hard-canon tails, update the lock safely, verify the executable repository state, then commit/publish/integrate only from a fully green result.

## 2026-09-13 — Iteration 2/5: material implementation

### Implemented
- Aligned development and production Composer contracts to the current Canon022/023/024/026 dependency and Symfony 8.1 baseline.
- Added the direct `symfony/event-dispatcher` runtime dependency and explicitly registered Symfony 8.1 `ServicesBundle` in the standalone and embedded-test bundle maps; this closes the manual `registerBundles()` gap exposed by FrameworkBundle's `RequiredBundle` contract.
- Untracked generated `config/reference.php` while preserving the local generated file under ignore policy.
- Added persistent PHPUnit path/branch coverage configuration and a stable `test:coverage` artifact at `var/coverage-summary.txt`.
- Added Doctrine Migrations Bundle, an overrideable `DATABASE_URL`, migration namespace configuration, and a clean-install PostgreSQL baseline migration.

### Verification
- PHPUnit after the ServicesBundle repair: PASS — 31 tests, 228 assertions at the repair checkpoint.
- PHPStan: PASS.
- CS check: PASS.
- `debug:container event_dispatcher`: PASS; the Symfony 8.1 dispatcher service is now present.

Что имеем? Symfony 8.1 standalone/test runtime is functional and the hard package/runtime canon gaps are materially closed.

Что осталось? Close Canon030 migration-chain parity and verify the complete resulting state rather than relying on the previous false-green RC wrapper.

## 2026-09-13 — Iteration 3/5: verification and fix

### Canon030 findings and repair
- Existing migrations could not reproduce current metadata from an empty database: the first historical migration required pre-existing attachment tables, and historical Objecting adoption used stale `object_*` and snake_case physical columns.
- Added `Version20260818000000` as an idempotent clean-install PostgreSQL baseline matching current Doctrine physical metadata.
- Hardened the two historical migrations so they become no-ops when the canonical baseline is already present.
- Added `Version20260913000000` to converge legacy snake_case and `object_*` deployments to the current physical schema.
- Updated `MigrateAttachmentIdentifiersCommand` so its destructive rebuild path emits the same current Doctrine physical columns, indexes, FK identity, nullable status, and camelCase business-column names instead of recreating drift.
- Updated the architecture regression test to assert the current maintenance-command DDL contract.

### Executable schema-parity contract
- Added Composer `schema:parity`: full migration chain, `doctrine:migrations:up-to-date`, then `doctrine:schema:validate`.
- Added disposable PostgreSQL 17 service and `pdo_pgsql` to CI; the CI job now executes `composer schema:parity`.
- Fixed the Doctrine Migrations YAML namespace after executable discovery exposed doubled literal backslashes; `doctrine:migrations:list` now sees all four migrations.
- Local PostgreSQL is not configured in this workspace, so production migration execution is intentionally delegated to the new disposable PostgreSQL CI contract rather than falsely proven against SQLite.
- Local `doctrine:schema:validate`: mapping PASS; existing local SQLite schema remains out of sync, as expected for a non-disposable pre-existing database.

### Verification
- Changed PHP lint: PASS — 8/8.
- Composer strict/check-lock: PASS.
- PHPUnit: PASS — 31 tests, 231 assertions.
- PHPStan: PASS — 0 errors.
- CS check: PASS — 0 of 92 files require fixes.
- Composer audit: PASS — no advisories.

Что имеем? Migration discovery, current metadata, maintenance DDL and CI schema-parity execution now describe one canonical schema model.

Что осталось? Measure final coverage, run bounded RC validation, record debt correctly, then integrate only if the repository gate is otherwise green.

## 2026-09-13 — Iteration 4/5: debt closure and integration readiness

### Coverage and RC evidence
- `test:coverage`: PASS with Xdebug 3.5.1 and persistent summary.
- Final measured coverage: lines 67.32%, methods 56.94%, branches 71.31%, paths 29.90%.
- Canon040 target 80/80/70 is not fully reached; branches exceed target while line/method coverage remains measured debt. The result is above the HIGH_TEST_DEBT floor and is recorded as non-hard remediation debt rather than hidden or misreported as target attainment.
- Bounded RC validator: Composer validation PASS, PHPStan PASS, PHPUnit PASS, coverage execution PASS, canon issue count 0. The only readiness blocker is the expected dirty-worktree state before integration.

### Integration posture
- Branch `refactor/canonical-attachment-tree-v2` tracks `origin/refactor/canonical-attachment-tree-v2`, ahead by one and behind by zero before the final commit.
- One earlier signed helper commit `2ace4c7` has an undesirably temporary message `tmp`; no amend capability is exposed by Console MCP, so history is not destructively rewritten. The final coherent commit will carry the meaningful RC closure and the handoff records this hygiene tail explicitly.

Что имеем? All locally executable RC gates are green; remaining readiness blocker is only uncommitted owned work. Coverage shortfall is explicit measured debt, not a hidden blocker.

Что осталось? Commit the owned closure batch, push, inspect PR checks/mergeability against the new head, and merge only if the remote safe-merge gate is green.

## 2026-09-13 — Iteration 5/5: final acceptance and handoff

### Acceptance before publication
- Composer strict/check-lock: PASS.
- PHP syntax: PASS for all changed/untracked PHP files.
- PHPUnit: PASS — 31 tests, 231 assertions.
- PHPStan: PASS — no errors.
- PHP-CS-Fixer check: PASS — 0/92 files require fixes.
- Composer audit: PASS — no security advisories.
- Doctrine migrations are registered and discoverable: four versions listed.
- Doctrine mapping validation: PASS; disposable PostgreSQL full-chain parity is materialized as a CI gate because no local PostgreSQL alias/DATABASE_URL is available.
- RC validator: zero canon issues and zero executable validation failures; only pre-commit dirty state blocks readiness.

Что имеем? Attaching is locally acceptance-green with an executable production schema-parity contract and explicit coverage debt accounting.

Что осталось? Publish the final signed commit and re-evaluate the existing remote PR at its new head; do not claim remote merge completion until checks and safe-merge inspection confirm it.
